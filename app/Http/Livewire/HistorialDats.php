<?php

namespace App\Http\Livewire;

use App\Models\Empleado;
use Livewire\Component;

use App\Models\Historial;
///libreria de carbon

use Carbon\Carbon;



class HistorialDats extends Component
{


    public $buscar;

    public function render()
    {
        $now =  Carbon::now();
        $history = Historial::with('empleados')
            ->where(function($query){
                $query->where('folio', 'LIKE', "%{$this->buscar}%")
                ->orWhere('fecha_entrada', 'LIKE', "%{$this->buscar}%")
                ->orWhere('hora_entrada', 'LIKE', "%{$this->buscar}%");
            })
            ->orWhereHas('empleados', function ($query) {
                if ($this->buscar) {
                    return $query->where('nombre', 'LIKE', "%" . $this->buscar . "%")
                        ->orWhere('apellido_p', 'LIKE', "%" . $this->buscar . "%");
                }
                
            })
            ->orderBy('id_historial', 'desc')
            ->paginate(6);

        return view('livewire.historial-dats', [
            'history' => $history
        ]);

    }
}
