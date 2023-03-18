<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Empleado;

use App\Models\Puesto;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Storage;



class EmpleadosController extends Controller
{     

    /**
     * 
     * 
     * Metodo para el filtro de registros
     * 
     */
    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');

        $todosEmpleados = Empleado::where('status', '1')
        ->where(function ($query) use ($buscar) {
            $query->where('nombre', 'LIKE', '%' . $buscar . '%')
                ->orWhere('apellido_p', 'LIKE', '%' . $buscar . '%')
                ->orWhere('apellido_m', 'LIKE', '%' . $buscar . '%');
        })
        ->get();

        if (count($todosEmpleados) == 0) {
            $empleados=Empleado::where('status', '1')->orderBy('folio', 'asc')->get();
                return view('recept.empleados.empleados', ['empleados' => [],
                    'empleados' => $empleados,
                    'mensaje' => 'No se encontraron empleados con esos nombres/apellidos.']);
        }
        
        return view('recept.empleados.empleados', ['empleados' => $todosEmpleados]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        $empleados=Empleado::where('status', '1')->orderBy('folio', 'asc')->get();

        return view('recept.empleados.empleados',compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $puestos=Puesto::all();
        return view('recept.empleados.new_empleado', compact('puestos'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'folio'=>'required',
            'nombre' => 'required',
            'imagen' => 'required'

        ];

        $messages = [
            'folio.required' => 'Es obligatorio agrega un folio.',
            'nombre.required' => 'Es obligatorio agrega un nombre.',
            'imagen.required' => 'Es obligatorio agrega una imagen.',
            
        ];

        $folio = $request->get('folio');
    
        $empleado  = Empleado::where('folio', $folio)->get()->first();
        if ($empleado) {
            return back()->withErrors(['algo' => 'El folio/nip proporcionado anteriormente ya existe, "escriba otro".']);
        }
        {
        $this->validate($request, $rules, $messages,[
            'folio'=>'required', 
            'nombre'=>'required', 
            'apellido_p'=>'required', 
            'apellido_m'=>'required', 
            'telefono'=>'required',
            'imagen'=>'required',
            'id_puesto'=>'required']);

            $imagen = $request -> file('imagen');
            $nombreImagen = 'empleados/'. time() . '.'.$imagen->extension();
            $imagen->move(public_path('storage/empleados'),$nombreImagen);

        
        $datos = Empleado::create([ 
            'folio'=> $request -> input('folio'),
            'nombre' => $request -> input('nombre'),
            'apellido_p' => $request -> input('apellido_p'),
            'apellido_m'=> $request -> input('apellido_m'),
            'telefono'=> $request -> input('telefono'),
            'imagen'=> $nombreImagen,
            'id_puesto'=> $request -> input('id_puesto'),
            'password'=> Hash::make($request->input('password')),
            'status' => '1'
            ]);
        return redirect('empleados');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($folio)
    {
        //

        $empleado=Empleado::find($folio);

        return response()->json([$empleado], 200);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($folio)
    {
        //
        //
        $id_folio = Empleado::find($folio);
        $puestos=Puesto::all();
        return view('recept.empleados.edit_empleado',compact('id_folio','puestos'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $folio)
    {
       //busco el elemento
        $empleado = Empleado::find($folio);
        $imagen = $request->file('imagen');
        $imagen_antigua = $empleado['imagen'];

        
       //verificacion si la variable esta tiene dato seleciona la imagen y eliminalo
        if ($imagen ) {

            $nombreImagen = 'empleados/' . time() . '.' . $imagen->extension();
            $imagen->move(public_path('storage/empleados'), $nombreImagen);

            Storage::disk('public')->delete('/' . $imagen_antigua);

            //si existe remplazo la imagen por la actual
            $empleado->update([

                'nombre' => $request -> input('nombre'),
                'apellido_p' => $request -> input('apellido_p'),
                'apellido_m'=> $request -> input('apellido_m'),
                'telefono'=> $request -> input('telefono'),
                'imagen' => $nombreImagen,
                'id_puesto'=> $request -> input('id_puesto'),
                'password' => Hash::make($request->input('password'))
            ]);

        }else{
            //si no existe pues guardo la imagen con sus valores predefindos
            $empleado->update([
                'nombre' => $request->input('nombre'),
                'apellido_p' => $request->input('apellido_p'),
                'apellido_m' => $request->input('apellido_m'),
                'telefono' => $request->input('telefono'),
                'id_puesto' => $request->input('id_puesto'),
                'password' => Hash::make($request->input('password'))
            ]);
        }

       //retorno
        return redirect('empleados');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($folio)
    {
        //captop el valor de la imagen 
        // $datos = DB::select("SELECT imagen FROM empleados WHERE folio = ?", [$folio]);

        // $imagen_antigua = $datos[0]->imagen;
        $empleado = Empleado::where('folio',$folio)->first();
    
        $imagen_antigua = $empleado['imagen'];
        if($imagen_antigua){
            Storage::disk('public')->delete('/'.$imagen_antigua);
            Empleado::where('folio', $folio)->update([
                'status' => '0',
                'imagen'=> null
            ]);

            return redirect('empleados');
        }else{
            Empleado::where('folio', $folio)->update([
                'status' => '0'
            ]);

        }

        // $datos = DB::select("SELECT imagen FROM empleados ");
        // //verefico si esta vacio
        // if($datos[0]->imagen==""){
        // //guardar la imagen
        
        //  Empleado::where('folio', $folio)->update([
        //     'status' => '0'
        //  ]);
        // }else{
        //     //y si exxiste eliminalo
        //     $imagen_antigua = DB::select("SELECT imagen FROM empleados");
        //      storage::delete('public/'.$imagen_antigua[0]->imagen);
        // }
        // Empleado::where('folio', $folio)->update([
            //     'status' => '0'
            // ]);

        return redirect('empleados');
        
    }
}
