<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturnSalario extends Controller
{
    //
    public function index()
    {
        return view('recept.salarios.salarios');
    }
}
