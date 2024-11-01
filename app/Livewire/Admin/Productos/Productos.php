<?php

namespace App\Livewire\Admin\Productos;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Productos extends Component
{
    use WithFileUploads;

    public $url;

    public $datos;

    public $imagen;

    public $descripcion;

    public $precio;

    public $descuento;

    public $nm_producto;

    public $categoria;

    public $stock;

    public $filtro = 'Todos';

    public $nombres;

    public $id;

    public $ver = false;

    public $buscado = '';

    public $alert = false;

    public $img = false;

    public $color;

    public $colores = [];

    public function actualizarcolor($color)
    {
        if (in_array($color, $this->colores)) {
            $this->colores = array_diff($this->colores, [$color]);
        } else {
            $this->colores[] = $color;
        }
    }

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->ver = false;
        $this->obtenerdatos();
    }

    // Método para buscar productos
    public function busqueda()
    {
        $productos = collect($this->datos);

        // Aplicar filtro si no es "Todos"
        if ($this->filtro !== 'Todos') {
            switch ($this->filtro) {
                case 'A - Z':
                    $productos = $productos->sortBy(function ($producto) {
                        return strtolower($producto['nm_producto']);
                    });
                    break;
                case 'Z - A':
                    $productos = $productos->sortByDesc(function ($producto) {
                        return strtolower($producto['nm_producto']);
                    });
                    break;
                case 'ANTIGUOS':
                    $productos = $productos->sortBy(function ($producto) {
                        return $producto['created_at'];
                    });
                    break;
                case 'RECIENTES':
                    $productos = $productos->sortByDesc(function ($producto) {
                        return $producto['created_at'];
                    });
                    break;
                case 'PRECIO MIN':
                    $productos = $productos->sortBy(function ($producto) {
                        return (float) $producto['precio'];
                    });
                    break;
                case 'PRECIO MAX':
                    $productos = $productos->sortByDesc(function ($producto) {
                        return (float) $producto['precio'];
                    });
                    break;
                case '':
                    $this->showAll();
                    break;
            }
        } else {
            $this->showAll();
        }
        if (empty($this->buscado)) {
            $this->showAll();
        }elseif (!empty($this->buscado)) {
            $productos = $productos->filter(function ($producto) {
                return str_contains(strtolower($producto['nm_producto']), strtolower($this->buscado));
            });
        } else {
            $this->showAll();
        }

        $this->datos = $productos->values()->all();

    }

    public function alertfalse()
    {
        $this->alert = false;
    }

    public function eliminar($id)
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->delete($this->url.'/EliminarProducto='.$id);
        if ($response->successful()) {
            session()->flash('success', 'Producto eliminado con exito');
            $this->alert = true;
            $this->obtenerdatos();
        } else {
            return back()->with('error', 'Error: '.$response->body());
        }
    }

    public function obtenerdatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarProductos');
        $respuesta = $response->json();
        $this->datos = $respuesta['productos'];
    }

    //Mostrar Todos
    public function showAll()
    {
        $this->obtenerdatos();
        $this->filtro = 'Todos';
    }

    //Filtrar de A - Z
    public function az()
    {
        $this->datos = collect($this->datos)->sortBy(function ($producto) {
            return strtolower($producto['nm_producto']);
        })->values()->all();
        $this->filtro = 'A - Z';
    }

    //Filtrar de Z - A
    public function za()
    {
        $this->datos = collect($this->datos)->sortByDesc(function ($producto) {
            return strtolower($producto['nm_producto']);
        })->values()->all();
        $this->filtro = 'Z - A';
    }

    //Filtrar por fecha antigua
    public function fechaup()
    {
        $this->datos = collect($this->datos)->sortBy(function ($producto) {
            return $producto['created_at'];
        })->values()->all();
        $this->filtro = 'ANTIGUOS';
    }

    //Filtrar por fecha nueva
    public function fechadown()
    {
        $this->datos = collect($this->datos)->sortByDesc(function ($producto) {
            return $producto['created_at'];
        })->values()->all();

        $this->filtro = 'RECIENTES';
    }

    //filtrar por precio min
    public function preciomin()
    {
        $this->datos = collect($this->datos)->sortBy(function ($producto) {
            return (float) $producto['precio'];
        })->values()->all();

        $this->filtro = 'PRECIO MIN';
    }

    //filtrar por precio max
    public function preciomax()
    {
        $this->datos = collect($this->datos)->sortByDesc(function ($producto) {
            return (float) $producto['precio'];
        })->values()->all();

        $this->filtro = 'PRECIO MAX';
    }

    //funcion para registrar servicio
    public function addProducto()
    {
        $cols = implode(',', $this->colores);

        if ($this->imagen) {
            $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->attach(
                'imagen',
                file_get_contents($this->imagen->getRealPath()),
                $this->imagen->getClientOriginalName()
            )->post($this->url.'/NuevoProducto', [
                'nm_producto' => $this->nm_producto,
                'descripcion' => $this->descripcion,
                'categoria' => $this->categoria,
                'precio' => $this->precio,
                'descuento' => $this->descuento,
                'colores' => $cols,
                'stock' => $this->stock,
            ]);

            if ($response->successful()) {
                $this->reset(['nm_producto', 'descripcion', 'categoria', 'precio', 'descuento', 'colores', 'stock', 'imagen']);
                $this->obtenerdatos();

                return back()->with('mensaje', 'Servicio registrado exitosamente');
            } else {
                return back()->with('error', 'Error: '.$response->body());
            }
        } else {
            return back()->with('error', 'Por favor, sube una imagen.');
        }
    }

    public function verproducto($id)
    {
        $this->id = $id;
        $this->ver = true;
    }

    public function ocultar()
    {
        $this->ver = false;
        $this->obtenerdatos();
    }

    public function render()
    {
        $this->busqueda();

        return view('livewire.admin.productos.productos');
    }
}
