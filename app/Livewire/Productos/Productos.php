<?php

namespace App\Livewire\Productos;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Productos extends Component
{
    public $url;
    public $datos;
    public $nombre;
    public $filtro = 'Todos';
    public function mount()
    {
        $this->url = env('API_URL', 'https://api-happypetshco-com.preview-domain.com/api');
        $this->obtenerdatos();
    }
    public function obtenerdatos()
    {
        $response = Http::withoutVerifying()->get($this->url . '/ListarProductos');
        $respuesta = $response->json();
        $productos = collect($respuesta['productos']);

         // Aplicar filtro basado en la selección
         if ($this->filtro === 'Descuento') {
            // Filtro: productos donde 'descuento' no sea 0 ni null
            $productos = $productos->filter(function ($producto) {
                return $producto['descuento'] !== 0 && !is_null($producto['descuento']);
            });
        } elseif ($this->filtro !== 'Todos') {
            $productos = $productos->filter(function ($producto) {
                return strtolower($producto['categoria']) === strtolower($this->filtro);
            });
        }

        // Ordenar por fecha de creación descendente y tomar los primeros 8 productos
        $this->datos = $productos
            ->sortByDesc(function ($producto) {
                return $producto['created_at'];
            })
            ->take(8)
            ->values()
            ->all();
    }

    public function cambiarFiltro($filtro){
        $this->filtro = $filtro;
        $this->obtenerdatos();
    }
    public function render()
    {
        return view('livewire.productos.productos');
    }
}
