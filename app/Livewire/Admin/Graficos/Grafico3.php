<?php

namespace App\Livewire\Admin\Graficos;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Grafico3 extends Component
{
    public $url;

    public $data;

    public $datos;

    public $productosMasVendidos = [];

    public function cargarDatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarCarrito');
        $respuesta = $response->json();
        $this->data = collect($respuesta['carritos'] ?? [])->filter(function ($item) {
            return $item['estado'];
        })->all();
        $this->procesarDatos();
    }

    public function procesarDatos() {
        // Agrupando los datos por estado de la compra
        $this->productosMasVendidos = collect($this->data)->groupBy('estado')->map(function ($estado) {
            return [
                'nombre' => $estado->first()['estado'],
                'cantidad' => $estado->sum('cantidad')
            ];
        })->sortByDesc('cantidad')->take(10)->values()->toArray();
    }


    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatos();
    }
    public function render()
    {
        return view('livewire.admin.graficos.grafico3');
    }
}
