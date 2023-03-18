<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Salario;

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
        return $salario = Salario::all();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $salario = new Salario();
        $salario->anio = $request->get('anio');
        $salario->mes = $request->get('mes');
        $salario->valor = $request->get('valor');
        $salario->fecha_inicio = $request->get('fecha_inicio');
        $salario->fecha_fin = $request->get('fecha_fin');
        $salario->id_puesto = $request->get('id_puesto');
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
        $salario = Salario::find($id);
        $salario->delete();
    }
}
