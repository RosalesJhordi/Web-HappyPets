<?php

namespace App\Livewire\Filtro;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Producto extends Component
{
    public $url;
    public $datos = [];
    public $nombre;
    public $filtro = 'Todos';
    public $data = [];
    public $colores = [];
    public $categorias = [];
    public $filtroCategorias = [];

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatos();
        $this->datos = $this->data;
    }

    public function cargarDatos()
    {
        $productosResponse = Http::withoutVerifying()->withToken(Session::get('authToken'))
            ->get("{$this->url}/ListarProductos");

        $categoriasResponse = Http::withoutVerifying()->withToken(Session::get('authToken'))
            ->get("{$this->url}/CategoriasArbol");

        $this->data = $productosResponse->json()['productos'] ?? [];
        $this->categorias = collect($categoriasResponse->json()['categorias'] ?? []);
    }

    public function filtrarDatos()
    {
        $filtrados = collect($this->data);

        // Filtrar por descuento
        if ($this->filtro === 'Descuento') {
            $filtrados = $filtrados->filter(fn($producto) => $producto['descuento'] ?? 0 > 0);
        }

        // Filtrar por colores
        if (!empty($this->colores)) {
            $filtrados = $filtrados->filter(function ($producto) {
                $productoColores = explode(',', $producto['colores']);
                return count(array_intersect($productoColores, $this->colores)) > 0;
            });
        }

        // Filtrar por categorías
        if (!empty($this->filtroCategorias)) {
            $filtrados = $filtrados->filter(fn($producto) => in_array($producto['categorias']['nombre'], $this->filtroCategorias));
        }

        $this->datos = $filtrados->values()->all();
    }

    public function updatedFiltro($value)
    {
        $this->filtro = $value;
        $this->filtrarDatos();
    }

    public function updatedColores()
    {
        $this->filtrarDatos();
    }

    public function updatedFiltroCategorias()
    {
        $this->filtrarDatos();
    }

    public function mostrarTodos()
    {
        $this->filtro = 'Todos';
        $this->filtrarDatos();
    }

    public function render()
    {
        return view('livewire.filtro.producto');
    }
}
