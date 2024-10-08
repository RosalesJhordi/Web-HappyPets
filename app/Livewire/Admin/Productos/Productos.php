<?php

namespace App\Livewire\Admin\Productos;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Productos extends Component
{
    use WithFileUploads;

    public $url = "https://api-happypetshco-com.preview-domain.com/api";
    public $totalproductos;
    public $datos;

    public $imagen;
    public $descripcion;
    public $precio;
    public $descuento;
    public $nm_producto;
    public $categoria;
    public $stock;

    public $filtro = "Todos";
    public $nombres;
    public $id;
    public $ver = false;

    public function mount()
    {
        $this->totalProd();
        $this->datos();
    }
    public function totalProd()
    {
        $response = Http::withoutVerifying()->get($this->url . '/ListarProductos');
        $respuesta = $response->json();
        $this->totalproductos = $respuesta['productos'];
    }
    public function datos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/ListarProductos');
        $respuesta = $response->json();
        $this->datos = $respuesta['productos'];
    }

    //Mostrar Todos
    public function showAll()
    {
        $this->datos();
        $this->filtro = "Todos";
    }

    //Filtrar de A - Z
    public function az()
    {
        $this->datos = collect($this->datos)->sortBy(function ($producto) {
            return strtolower($producto['nm_producto']);
        })->values()->all();
        $this->filtro = "A - Z";
    }

    //Filtrar de Z - A
    public function za()
    {
        $this->datos = collect($this->datos)->sortByDesc(function ($producto) {
            return strtolower($producto['nm_producto']);
        })->values()->all();
        $this->filtro = "Z - A";
    }

    //Filtrar por fecha antigua
    public function fechaup()
    {
        $this->datos = collect($this->datos)->sortBy(function ($producto) {
            return $producto['created_at'];
        })->values()->all();
        $this->filtro = "ANTIGUOS";
    }

    //Filtrar por fecha nueva
    public function fechadown()
    {
        $this->datos = collect($this->datos)->sortByDesc(function ($producto) {
            return $producto['created_at'];
        })->values()->all();

        $this->filtro = "RECIENTES";
    }

    //filtrar por precio min
    public function preciomin()
    {
        $this->datos = collect($this->datos)->sortBy(function ($producto) {
            return (float)$producto['precio'];
        })->values()->all();

        $this->filtro = "PRECIO MIN";
    }

    //filtrar por precio max
    public function preciomax()
    {
        $this->datos = collect($this->datos)->sortByDesc(function ($producto) {
            return (float)$producto['precio']; 
        })->values()->all();

        $this->filtro = "PRECIO MAX";
    }

    //funcion para registrar servicio
    public function addProducto()
    {
        if ($this->imagen) {
            $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->attach(
                'imagen',
                file_get_contents($this->imagen->getRealPath()),
                $this->imagen->getClientOriginalName()
            )->post($this->url . '/NuevoProducto', [
                'nm_producto' => $this->nm_producto,
                'descripcion' => $this->descripcion,
                'categoria' => $this->categoria,
                'precio' => $this->precio,
                'descuento' => $this->descuento,
                'stock' => $this->stock,
            ]);

            if ($response->successful()) {
                $this->reset(['nm_producto', 'descripcion', 'categoria', 'precio', 'descuento', 'stock', 'imagen']);
                $this->datos();
                return back()->with('mensaje', 'Servicio registrado exitosamente');
            } else {
                return back()->with('error', "Error: " . $response->body());
            }
        } else {
            return back()->with('error', "Por favor, sube una imagen.");
        }
    }

    public function verproducto($id){
        $this->id = $id;
        $this->ver = true;
    }
    public function ocultar(){
        $this->ver = false;
    }
    public function render()
    {
        return view('livewire.admin.productos.productos');
    }
}
