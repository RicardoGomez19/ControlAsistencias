<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturnPuesto extends Controller
{
    //
    public function index()
    {
        return view('recept.puestos.puestos');
    }
}
