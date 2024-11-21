<?php

namespace App\Livewire\Veterinarios;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Inicio extends Component
{
    public $url;

    public $datos;

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->veterinarios();
    }

    public function veterinarios()
    {

        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->withOptions([
            'verify' => false,
        ])->get($this->url.'/Usuarios');
        $respuesta = $response->json();

        $this->datos = array_filter($respuesta['usuarios'], function ($usuario) {
            return in_array('Veterinario', $usuario['permisos']);
        });
    }

    public function render()
    {
        return view('livewire.veterinarios.inicio');
    }
}
