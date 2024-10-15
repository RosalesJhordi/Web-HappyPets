<?php

namespace App\Livewire\Productos;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Descuentos extends Component
{
    public $url;

    public $datos;

    public $nombre;

    public $categorias;

    public $data = [];

    public function mount()
    {
        $this->url = env('API_URL', 'https://api-happypetshco-com.preview-domain.com/api');
        $this->datosslide();
        $this->obtenerdatos();

    }

    public function obtenerdatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarProductos');
        $respuesta = $response->json();
        $this->datos = $respuesta['productos'];

        $this->datos = collect($this->datos)
            ->filter(function ($producto) {
                return ! is_null($producto['descuento']) && $producto['descuento'] > 0;
            })
            ->sortByDesc(function ($producto) {
                return $producto['created_at'];
            })
            ->take(8)
            ->values()
            ->all();
    }

    public function datosslide()
    {
        $respons = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/ListarProductos');
        $resp= $respons->json();
        if (isset($resp['productos']) && is_array($resp['productos'])) {
            $this->data = $resp['productos'];
            $this->categorias = collect($this->data)
            ->pluck('categoria')
            ->unique()
            ->values()
            ->all();
        }
    }

    public function render()
    {
        return view('livewire.productos.descuentos');
    }
}
