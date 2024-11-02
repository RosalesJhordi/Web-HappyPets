<?php

namespace App\Livewire\Servicios;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Inicio extends Component
{
    public $url;
    public $datos;
    public function mount(){
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->servicios();
    }
    public function servicios(){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->
        get($this->url . '/ListarServicios');
        $respuesta = $response->json();

        $this->datos = $respuesta['servicios'];

        $this->datos = collect($this->datos)
            ->sortByDesc(function ($servicio) {
                return $servicio['created_at'];
            })
            ->take(8)
            ->values()
            ->all();
    }
    public function render()
    {
        return view('livewire.servicios.inicio');
    }
}
