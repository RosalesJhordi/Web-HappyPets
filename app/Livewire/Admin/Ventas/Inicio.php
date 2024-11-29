<?php

namespace App\Livewire\Admin\Ventas;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Inicio extends Component
{
    public $url;
    public $dataTabla;
    public $datos;
    public $data;
    public $nombre;
    public $filtro = 'Todos';
    public $colores = [];
    public $categorias = [];
    public $filtroCategorias = [];
    public $datosTabla;
    public $seccionVenta = false;
    public $datosProducto;
    public function cargarDatos()
{
    $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarCarrito');
    $respuesta = $response->json();
    $this->dataTabla = collect($respuesta['carritos'] ?? [])
        ->filter(function ($item) {
            return $item['estado'] === 'Pagado' && $item['pagado'] === 'Confirmado';
        })
        ->sortByDesc(function ($item) {
            return $item['created_at'];
        })
        ->values()
        ->all();
    $this->datosTabla = $this->dataTabla;
}

    public function cargarDatosProductos()
    {
        $categoriasResponse = Http::withoutVerifying()->withToken(Session::get('authToken'))
            ->get("{$this->url}/CategoriasArbol");

        $this->categorias = collect($categoriasResponse->json()['categorias'] ?? []);
    }
    public function Productos()
    {
        $resp = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/ListarProductos');
        $respuest = $resp->json();
        $this->datos = $respuest['productos'];

        $this->datosProducto = collect($this->datos)
            ->sortByDesc(function ($producto) {
                return $producto['created_at'];
            })
            ->values()
            ->all();
    }
    public function filtrarDatos()
    {
        $filtrados = collect($this->datos);

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

        $this->datosProducto = $filtrados->values()->all();
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
    public function updatedSeccionVenta(){
        if($this->seccionVenta){
            $this->Productos();
        }else{
            $this->datosTabla = $this->dataTabla;
        }
    }
    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatos();
        $this->Productos();
        $this->cargarDatosProductos();
        $this->datosProducto = $this->datosProducto;
    }
    public function render()
    {
        return view('livewire.admin.ventas.inicio');
    }
}
