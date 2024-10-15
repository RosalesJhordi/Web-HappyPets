<?php

namespace App\Livewire\Datos;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class DatosUsuario extends Component
{
    public $url;
    public $nombres;
    public $permisos;

    public function cargarDatosUsuario(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/DatosUsuario');

        if ($response->successful()) {
            $data = $response->json();
            $this->nombres = $data['usuarios']['nombres'];
            $this->permisos = $data['usuarios']['permisos'];
            $dataaa = $this->permisos;
            if (is_string($dataaa)) {
                $permiso = explode(',', $dataaa);
            }
            Session::put('permisos', $permiso);
        }
    }
    public function mount(){
        $this->url = env('API_URL', 'https://api-happypetshco-com.preview-domain.com/api');
        $this->cargarDatosUsuario();
    }
    public function deletetoken(){
        Session::forget('authToken');
        return redirect()->route('/');
    }
    public function render()
    {
        return view('livewire.datos.datos-usuario');
    }
}
