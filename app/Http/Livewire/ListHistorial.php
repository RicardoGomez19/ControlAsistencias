<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Historial;
use App\Models\Empleado;
use App\Models\Salario;
use Illuminate\Support\Facades\DB;

//uso carbon fechas
use Carbon\Carbon;


use DateTime;
use Illuminate\Http\Request;

class ListHistorial extends Component
{

	public $ids, $folio, $hr_salida, $hora_salida, $totalhr, $password, $sueldo, $puesto, $id_puesto;

    public function render()
    {

        $now =  Carbon::now();


        $fechaActual= $now->format('Y-m-d');

        $varActivo=1;


        $history= Historial::where('id_statu', $varActivo)->get();

        return view('livewire.list-historial', compact('history'));
    }

    public function ConfirmHrS($id){

        $this->emit('MostrarModal');
       // $this->folio=$id;

        $now =  Carbon::now();

        $this->hora_salida=$now->format('G:i:s');

        $this->ids=$id;

        $datos = Historial::find($id);

        $folio=$datos->folio;

        $this->folio=$folio;

          //capturo los valores de la entrada para calcular el total de horas de trabajo
        $hr_entrada= $datos->hora_entrada;

        $h1 = $hr_entrada;

        
        $h2 = $this->hora_salida;

        $time1 = new DateTime($h1);
        $time2 = new DateTime($h2);
        $interval = $time1->diff($time2);

        $this->totalhr = $interval->format('%H:%i'); //00 años 0 meses 0 días 08 horas 0 minutos 0 segundos

        // Obtener el salario mínimo correspondiente a la fecha de la entrada
         $fecha_entrada = $datos->fecha_entrada;
        $puesto = $datos->id_puesto;

        $salario = Salario::where('fecha_inicio', '<=', $fecha_entrada)
            ->where('fecha_fin', '>=', $fecha_entrada)
            ->where('id_puesto', $puesto)
            ->first();
        
        if ($salario) {
            $salario_minimo = $salario->valor;

            // // Calcular el sueldo correspondiente a las horas trabajadas
            // $horas_trabajadas = intval(substr($this->totalhr, 0, 2));
            // $minutos_trabajados = intval(substr($this->totalhr, 3, 2));
            // $salario_por_hora = $salario_minimo / 8; // 8 horas de trabajo diarias

            // if ($horas_trabajadas >= 8) {
            //     // Si trabajó más de 8 horas, se le paga el doble por las horas extra
            //     $horas_normales = 8;
            //     $horas_extra = $horas_trabajadas - 8;
            //     $salario_por_hora_extra = $salario_por_hora * 2;
            //     $this->sueldo = ($horas_normales * $salario_por_hora) + ($horas_extra * $salario_por_hora_extra);
            // } else {
            //     $this->sueldo = ($horas_trabajadas * $salario_por_hora) + ($minutos_trabajados / 60 * $salario_por_hora);

            //     if ($horas_trabajadas < 8) {
            //         // Si trabajó menos de 8 horas, se le descuenta el 20% del sueldo
            //         $this->sueldo *= 0.8;
            //     }
            // }
            $horas_trabajadas = intval(substr($this->totalhr, 0, 2));
            $minutos_trabajados = intval(substr($this->totalhr, 3, 2));
            $salario_por_hora = $salario_minimo / 8; // 8 horas de trabajo diarias
            $salario_por_minuto = $salario_por_hora / 60; // Salario por minuto

            if ($horas_trabajadas >= 8) {
                // Si trabajó más de 8 horas, se le paga el doble por las horas extra
                $horas_normales = 8;
                $horas_extra = $horas_trabajadas - 8;
                $minutos_extra = $minutos_trabajados;
                $salario_por_hora_extra = $salario_por_hora * 2;
                $salario_por_minuto_extra = $salario_por_hora_extra / 60;

                // Salario por las horas trabajadas de manera normal
                $salario_horas_normales = $horas_normales * $salario_por_hora;

                // Salario por los minutos trabajados en la hora extra
                $salario_minutos_extra = $minutos_extra * $salario_por_minuto_extra;

                // Salario total
                $this->sueldo = $salario_horas_normales + $salario_minutos_extra;
            } else {
                // Si trabajó menos de 8 horas, se le paga según el salario por hora y los minutos trabajados
                $this->sueldo = ($horas_trabajadas * $salario_por_hora) + ($minutos_trabajados * $salario_por_minuto);

                if ($horas_trabajadas < 8) {
                    // Si trabajó menos de 8 horas, se le descuenta el 20% del sueldo
                    $this->sueldo *= 0.8;
                }
            }
            
            // Por ejemplo, enviar un correo electrónico o guardar la información en la base de datos
            } else {
            session()->flash('error', 'No se encontró un salario mínimo para la fecha de la entrada');
        }
        
    }

    public function RegSalida(Request $request){

        
        $dato = Historial::find($this->ids);
    
        // Validar contraseña
        $password = $this->password;
        //$empleado = Empleado::find($this->folio);


        $consulta = Empleado::where('folio','=', $this->folio, 'AND', 'password','=', $this->password)->first();

        
        if (!$consulta) {
            session()->flash('errorContra', 'Empleado no encontrado');
            $this->password = '';
            return;
        }
        if (!password_verify($this->password, $consulta['password'])) {
            session()->flash('errorContra', 'Contraseña incorrecta');
            $this->password = '';
            return;
        }
        $statu=2;
        $id= $this->id;
        $id_puesto= $this->id_puesto;
        
        $dato->update([

            'hora_salida'=>$this->hora_salida,
            'totalhr'=>$this->totalhr,
            'id'=>$this->sueldo,
            'id_puesto'=>$dato->id_puesto,
            'id_statu'=>$statu

        ]);
        
        $this->emit('concluido');
        // Establece el valor del modelo de wire para la contraseña en una cadena vacía
        $this->password = '';
        $mensaje2 = "Excelente. ¡Disfrute el resto de su día {$consulta['nombre']} {$consulta['apellido_p']}!";
        session()->flash('exit', $mensaje2);

    }
}
