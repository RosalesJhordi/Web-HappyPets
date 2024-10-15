<?php

namespace App\Livewire\Productos;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Todos extends Component
{
    public $url;
    public $datos;
    public $nombre;
    public function mount()
    {
        $this->url = env('API_URL', 'https://api-happypetshco-com.preview-domain.com/api');
        $this->obtenerdatos();
    }
    public function obtenerdatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/ListarProductos');
        $respuesta = $response->json();
        $this->datos = $respuesta['productos'];

        $this->datos = collect($this->datos)
            ->sortByDesc(function ($producto) {
                return $producto['created_at'];
            })
            ->take(8)
            ->values()
            ->all();
    }
    public function render()
    {
        return view('livewire.productos.todos');
    }
}
