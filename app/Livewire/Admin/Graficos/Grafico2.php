<?php

namespace App\Livewire\Admin\Graficos;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Grafico2 extends Component
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
            return $item['estado'] === 'Pagado' && $item['pagado'] === 'Confirmado';
        })->all();
        $this->procesarDatos();
    }

    public function procesarDatos()
{
    $this->productosMasVendidos = collect($this->data)
        ->groupBy('id_producto')
        ->map(function ($producto) {
            return [
                'nombre' => $producto->first()['producto']['nm_producto'],
                'cantidad' => $producto->sum('cantidad'),
            ];
        })
        ->sortByDesc('cantidad')
        ->take(6)
        ->values()
        ->toArray();
}


    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatos();
    }

    public function render()
    {
        return view('livewire.admin.graficos.grafico2');
    }
}
