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
        return view('Admin.Secciones.Home');
    }
    public function productos(){
        return view('Admin.Secciones.Productos');
    }
    public function servicios(){
        return view('Admin.Secciones.Servicios');
    }
    public function citasHoy(){
        return view('Admin.Secciones.CitasHoy');
    }
    public function citasSemana(){
        return view('Admin.Secciones.CitasSemana');
    }
    public function citasMes(){
        return view('Admin.Secciones.CitasMes');
    }
    public function mascotas(){
        return view('Admin.Secciones.Mascotas');
    }
    public function clientes(){
        return view('Admin.Secciones.Clientes');
    }
    public function empleados(){
        return view('Admin.Secciones.Empleados');
    }

    public function show($id){
        $url = env('API_URL', '');

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
