<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Puesto;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $puestos=Puesto::where('status', '1')->get();
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
        $puesto = new Puesto();
        $puesto->puesto = $request->get('puesto');
        $puesto->status = $request->get('status');
        $puesto->save();

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
        return $puesto=Puesto::find($id);

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
        $puesto=Puesto::find($id);
        $puesto->puesto = $request->get('puesto');
        $puesto->status = $request->get('status');
        $puesto->update();

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
        // $puesto=Puesto::find($id);
        // $puesto->delete();
        $puesto = Puesto::where('id_puesto', $id)->update(['status' => "0"]);
        if (!$puesto) {
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
                "data" => Puesto::where('id_puesto', $id)->get()->first(),
                "error" => null
            ];
            return response($success_message, 200);
        }
    }

    
}
