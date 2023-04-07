<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Salario;
use App\Models\Puesto;

class SalariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $salario = Salario::where('status', '1')->get();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_puesto = $request->get('id_puesto');

        $salario  = Salario::where('id_puesto', $id_puesto)->get()->first();
        if ($salario) {
            return response("error to save", 500);
        }
        //
        $salario = new Salario();
        $salario->anio = $request->get('anio');
        $salario->mes = $request->get('mes');
        $salario->valor = $request->get('valor');
        $salario->fecha_inicio = $request->get('fecha_inicio');
        $salario->fecha_fin = $request->get('fecha_fin');
        $salario->id_puesto = $request->get('id_puesto');
        $salario->status = $request->get('status');
        $salario->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $salario = Salario::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $salario = Salario::find($id);
        $salario->anio = $request->get('anio');
        $salario->mes = $request->get('mes');
        $salario->valor = $request->get('valor');
        $salario->fecha_inicio = $request->get('fecha_inicio');
        $salario->fecha_fin = $request->get('fecha_fin');
        $salario->id_puesto = $request->get('id_puesto');
        $salario->status = $request->get('status');
        $salario->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // $salario = Salario::find($id);
        // $salario->delete();
        $salario = Salario::where('id', $id)->update(['status' => "0"]);
        if (!$salario) {
            $error_message = [
                "ok" => false,
                "data" => null,
                "error" => [
                    "message:" => "Resource not found with id $id"
                ]
            ];
            return response($error_message, 404);
        } else {
            $success_message = [
                "ok" => true,
                "data" => Salario::where('id', $id)->get()->first(),
                "error" => null
            ];
            return response($success_message, 200);
        }
    }

}
