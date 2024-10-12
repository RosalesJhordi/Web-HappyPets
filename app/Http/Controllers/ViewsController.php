<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

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

    public function admin(){
        return view('Admin.Inicio');
    }

    public function show($id){
        $url = "https://api-happypetshco-com.preview-domain.com/api";
    
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '. Session::get('authToken'),
        ])->withoutVerifying()->get($url . '/BuscarProducto=' . $id);
    
        if ($response->successful()) {
            $serv = $response->json();
            $producto = $serv['producto'];
            return view('Productos', compact('producto'));
        } else {
            return redirect()->back()->with('error', 'No se pudo obtener el servicio.');
        }
    }    
}
