<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use App\Models\Puesto;
use Livewire\Component;


///libreria de carbon

use Carbon\Carbon;



class BuscarEmpleados extends Component
{
    public $buscar;
    public function render()
    {
        $now =  Carbon::now();
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
        ->paginate(6);

        return view('livewire.buscar-empleados', [
            'empleados' => $empleados
        ]);

    }

}
