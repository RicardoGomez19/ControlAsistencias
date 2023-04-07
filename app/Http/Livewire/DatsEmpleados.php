<?php

namespace App\Http\Livewire;

use Livewire\Component;


use App\Models\Empleado;

class DatsEmpleados extends Component
{

	public $buscar;

    public function render()
    {
        //le digo que me almacene los datos del la clase Empleado y que me lo ordene por la id de manera desc
        //le paso el where para el filtro de datos
        $empleados = Empleado::with('puestos')
        ->where('status', '1')
        ->where(function ($query) {
            $query->where('folio', 'LIKE', "%{$this->buscar}%")
            ->orWhere('nombre', 'LIKE', "%{$this->buscar}%")
            ->orWhere('apellido_p', 'LIKE', "%{$this->buscar}%")
            ->orWhere('apellido_m', 'LIKE', "%{$this->buscar}%")
            ->orWhereHas('puestos', function ($query) {
                if ($this->buscar) {
                    return $query->where('puesto', 'LIKE', "%" . $this->buscar . "%");
                }
                $query->where('status', '1');
            });
        })

        ->orderBy('folio', 'asc')
        ->get();
 
    	//$empleados = Empleado::all();
        return view('livewire.dats-empleados', compact('empleados'));
    }


}
