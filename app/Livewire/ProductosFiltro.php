<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ProductosFiltro extends Component
{
    public $url;
    public $datos;
    public $nombre;
    public $filtro = 'Todos';
    public function mount(){
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->obtenerdatos();
    }
    public function showAll()
    {
        $this->filtro = 'Todos';
        $this->obtenerdatos();
    }
    public function obtenerdatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/ListarProductos');
        $respuesta = $response->json();
        $this->datos = $respuesta['productos'];
        dump($this->datos);
    }

    public function za()
    {
        $this->datos = collect($this->datos)->filter(function ($producto) {
            return $producto['descuento'] !== 0 && !is_null($producto['descuento']);
        })->values()->all();
        $this->filtro = 'Descuento';
    }
    public function render()
    {
        return view('livewire.productos-filtro');
    }
}
