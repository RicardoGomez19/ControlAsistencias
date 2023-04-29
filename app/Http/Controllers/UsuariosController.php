<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;


class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //return $usuarios = Usuario::where('status', '1')->get();
        return $usuarios = Usuario::where('status', '1')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario();
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->username = $request->get('username');
        $usuario->password = Hash::make($request->get('password'));
        $usuario->status = $request->get('status');
        $usuario->save();
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
        return $usuario = Usuario::find($id);
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
        $password = $request->get('password');
        
        //
        $usuario = Usuario::find($id);
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->username = $request->get('username');
        if (!empty($password)) {
            $usuario->password = Hash::make($password);
        }
        $usuario->status = $request->get('status');
        $usuario->update();
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
        $usuario = Usuario::where('id', $id)->update(['status' => "0"]);
        if (!$usuario) {
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
                "data" => Usuario::where('id', $id)->get()->first(),
                "error" => null
            ];
            return response($success_message, 200);
        }
    }
}
