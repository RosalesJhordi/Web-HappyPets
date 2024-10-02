<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ViewsController extends Controller
{
    //funcion para mostrar el form registro
    public function registro(){
        return view('Auth.Registro');
    }

    //Funcion para  mosstrar el form autenticarse
    public function login(){
        return view('Auth.Login');
    }
}
