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

        $history = Historial::where('folio','LIKE',"%{$this->buscar}%")
            ->orWhere('fecha_entrada','LIKE',"%{$this->buscar}%")
            ->orderBy('id_historial', 'desc')->get();
        //$history = Historial::orderBy('id_historial', 'desc')->get();

        return view('livewire.historial-dats',[
            'history'=>$history
        ]);
    }


}
