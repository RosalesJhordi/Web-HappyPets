<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Url;
use Livewire\Component;

class Inicio extends Component
{
    public $notificacion;
    public $activeButton;
    public $datos_usuario;
    public $url;
    public $permisos = [];

    public function cargarDatosUsuario(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/Datos');

        if ($response->successful()) {
            $data = $response->json();
            $this->permisos = $data['usuarios']['permisos'] ?? [];
        }
    }
    public function mount(){
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatosUsuario();
    }
    public function render()
    {
        return view('livewire.admin.inicio');
    }
}
