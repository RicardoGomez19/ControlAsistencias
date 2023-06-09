<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Historial;
use App\Models\Puesto;
use App\Models\Salario;
use App\Models\Usuario;

class Dashboard extends Controller
{
    //
    public function index(){
        $totalEmpleados = Empleado::where('status', '1')->count();
        $totalPuestos = Puesto::where('status', '1')->count();
        $totalSalarios = Salario::where('status', '1')->count();
        $totalHistoriales = Historial::all()->count();
        $totalUsuarios = Usuario::where('status', '1')->count();
        return view('recept.dashboard.dashboard', compact('totalEmpleados', 'totalPuestos', 'totalSalarios', 'totalHistoriales', 'totalUsuarios'));
    }
}
