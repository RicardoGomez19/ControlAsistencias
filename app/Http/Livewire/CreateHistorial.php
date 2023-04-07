<?php

namespace App\Http\Livewire;

use App\Models\Empleado;

use App\Models\Historial;

use Livewire\Component;

use Illuminate\Support\Facades\Storage;


///libreria de carbon

use Carbon\Carbon;


class CreateHistorial extends Component
{
    public $folio, $nombre, $apellido_p, $apellido_m, $puesto, $id_puesto , $imagen, $mensaje4, $mensajeUser;

    public $dia, $hr_entrada;

    public $hayError = false;
    
    public $message = '';

    public function render()
    {

        $now =  Carbon::now();


        $this->dia= $now->format('Y/m/d');

        $this->hr_entrada=$now->format('G:i:s');



        // Buscar si el folio ya está en uso
        $historialExistente = Historial::where('folio', $this->folio)
            // ->whereDate('fecha_entrada', $this->dia)
            //     ->where(function ($query) {
            //         $query->whereNull('hora_salida')
            //             ->orWhere('hora_salida', '>=', $this->hr_entrada);
            //     })
            //     ->first();
            ->whereDate('fecha_entrada', $this->dia)
            ->first();
        
        if ($historialExistente) {
            // Si ya hay un registro en curso para el folio, lanzar una excepción
            $mensaje = "El empleado con folio {$this->folio} ya se a registrado el dia de hoy";
            session()->flash('MensajeExiste', $mensaje);
            $hayError = true;
        } else {
            $hayError = false;
        }

        // Si existe un mensaje en la sesión flash, no cargar los datos del formulario
        if (session()->has('MensajeExiste')) {
            $mensaje = session('MensajeExiste');
            return view('livewire.create-historial',
            compact('now', 'mensaje', 'hayError'));
        }
        
        return view('livewire.create-historial', compact('now'));
    }

    

    //metodo para otener los datos del empleados
    public function ObtenerDat()
    {
        if ($this->hayError) {
            return;
        }
        $this->validate([
            'folio'=>'required'
        ]) ;

        $datos = Empleado::where('folio', $this->folio)->where('status', '1')->first();

        if($datos){

            $this->nombre= $datos->nombre;   

            $this->apellido_p= $datos->apellido_p;
    
            $this->apellido_m= $datos->apellido_m;
    
            $this->puesto= $datos->puestos->puesto;
    
            if(!empty($this->imagen)){
                $this->imagen=$datos->imagen->store("public");
            }else{
                $this->imagen= null;
            }

        }else{
            $mensaje3 = "El empleado con folio " . $this->folio . " no trabaja en esta empresa.";
            session()->flash('MensajeD', $mensaje3);

            $this->nombre= '';   

            $this->apellido_p= '';
    
            $this->apellido_m= '';
    
            $this->puesto= '';
        
        }
        

    }

     //metodo para limpiar los datos al cerrar modals
    public function cerraModal(){

        $this->folio='';

        $this->nombre= '';   

        $this->apellido_p= '';

        $this->apellido_m= '';

        $this->puesto= '';   
    }

    //metodo para guardar el nuevo registro.
    public function createHistorial(){

        $this->validate([

            'folio'=>'required',
            'dia'=>'required',
            'hr_entrada'=>'required',

        ]);
        
        $datos = Empleado::where('folio', $this->folio)->first();

        $statu=1;
        
        if ($datos) {
            # code...
            Historial::create([
            'folio' => $this->folio,
            'fecha_entrada' => $this->dia,
            'hora_entrada'=>$this->hr_entrada,
            'id_puesto'=>$datos->id_puesto,
            'id_statu'=>$statu,
            ]);

                $this->folio='';

                $this->dia='';


                $this->hr_entrada='';

                $this->nombre=''; 

                $this->apellido_p='';
                
                $this->apellido_m='';
                
                $this->puesto='';


            //ocultar modal , se utiliza el emit para ocultar el modal y se manda al script
                
            // $mensaje = "Bienvenido a la empresa{} ya está en curso.";
            // session()->flash('MensajeExiste', $mensaje);
            // return redirect()->back
                $this->emit('ocultarModal');

            // session()->flash('exito','Bienvenido tu registro fue exitoso.');
                $mensaje ="Bienvenido a la empresa";
                $mensajeDatos="{$datos['nombre']} {$datos['apellido_p']}.";
                

                $this->emit('mensajes', $mensaje, $mensajeDatos);

            //dd($mensaje);
            
            
        }else{
            session()->flash('Existe', 'Asigne correctamente su folio');
        }
        
    }
    //fin de la funcion
    

}
