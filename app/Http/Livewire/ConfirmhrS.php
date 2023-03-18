<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Historial;

use App\Models\Empleado;

//uso carbon fechas
use Carbon\Carbon;

use DateTime;


class ConfirmhrS extends Component
{

	//variables a utilizar

	public $folio, $hr_salida;

	//variables para mostrar history

	public $nombre, $fecha, $hr_entrada, $totalhr, $puesto;
    

    public function render()
    {

        $now =  Carbon::now();


        $this->hr_salida=$now->format('G:i:s a');
        
        
        return view('livewire.confirmhr-s');
    }

    public function obtenerHistorial(){

        $this->validate([
            'folio'=>'required'
        ]) ;

         //variable que captura la fecha de hoy 

        $now =  Carbon::now();


        $fechaActual= $now->format('Y/m/d');

        $nombres = Empleado::where('folio', $this->folio)->first();

        $datos = Historial::where('folio', $this->folio)->orWhere('fecha_entrada', $fechaActual)->first();

        if($datos){

            $this->nombre= $nombres->nombre;   

            $this->fecha = $datos->fecha_entrada;

            $this->hr_entrada = $datos->hora_entrada;

        }else{
            $mensaje4 = "El empleado con folio " . $this->folio. " no trabaja en esta empresa.";
            session()->flash('MensajeD', $mensaje4);

        
        }

        return view('livewire.confirmhr-s');
        

    }//aqui termina el metodo 

    public function confirmarSalida(){
            
        $this->validate([
            'hr_salida'=>'required'
        ]);

        $now =  Carbon::now();

        $fechaActual= $now->format('Y-m-d');
            /////////////////////7///////7Consulta al model ///////////////////////////por qui ha de ver algun error 
        $datos = Historial::find($this->folio);


        $dia=$datos->fecha_entrada;
        
         //capturo los valores de la entrada para calcular el total de horas de trabajo
        $hr_entrada= $datos->hora_entrada;

        $h1 = $hr_entrada;

        $h2 = $this->hr_salida;

            $time1 = new DateTime($h1);
            $time2 = new DateTime($h2);
            $interval = $time1->diff($time2);

            $this->totalhr = $interval->format('%H:%i:%s ');//00 años 0 meses 0 días 08 horas 0 minutos 0 segundos

        //termina la logica para capturar el valor de las horas de trabajo

        if ($fechaActual=$dia) {

            $datos->update([
                'hora_salida'=>$this->hr_salida,
                'totalhr'=>$this->totalhr
            ]);
        # code...
        }
        



    }
}
