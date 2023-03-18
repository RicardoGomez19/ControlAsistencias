<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

     //contructor del middlware

//    public function __construct() {
//     $this->middleware('guest', ['only'=>'MostrarLogin']);
//    }
 
   //metodo para no motsrar al usuario autenticado el login
   public function MostrarLogin()
   {
    return view('auth.login');
   }

   //inicia el codigo para validar el login
   public function login()
   {
        //validamos los datos del formulario 
  
        $credenciales = $this->validate(request(), [
          //validamos los datos  
          'username'=>'required|string',
          'password'=>'required|string'
        ]);
  
      //validando el login
  
      if(Auth::attempt($credenciales)){
        
        return redirect('dashboard');
     
      }
  
      return back()->withErrors(['Credenciales'=>'Estas credenciales no coiciden con nuestros registros! Inserte datos validos.']);
  
   }

   //metodo para salir o cerrar session
 public function salir(){
   
   Auth::logout();
   
   return redirect('login');

 }


}
