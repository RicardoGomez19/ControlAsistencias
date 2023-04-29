<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturnUsuario extends Controller
{
    //
    public function index()
    {
        return view('recept.usuarios.usuarios');
    }
}
