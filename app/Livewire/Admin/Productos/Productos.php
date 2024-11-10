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

    public $subcategoria;

    public $subsubcategoria;

    public $sub_categoria;

    public $sub_sub_categoria;

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

    public $colorr;

    public $data;

    public $categorias;

    public $cat1;

    public $cat2;

    public $cat3;

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
            $productos = $this->aplicarFiltro($productos);
        }

        // Filtro de búsqueda por nombre
        if (! empty($this->buscado)) {
            $productos = $productos->filter(function ($producto) {
                return str_contains(strtolower($producto['nm_producto']), strtolower($this->buscado));
            });
        } else {
            $this->obtenerdatos();
        }

        $this->datos = $productos->values()->all();

    }

    public function updatedbuscado()
    {
        $this->obtenerdatos();
    }

    public function eliminar($id)
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->delete($this->url.'/EliminarProducto='.$id);
        if ($response->successful()) {
            $this->dispatch('correcto', 'Producto eliminado con exito');
            $this->alert = true;
            $this->obtenerdatos();
        } else {
            return back()->with('error', 'Error: '.$response->body());
        }
    }

    public $categoriasAll;

    public function obtenerdatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarProductos');
        $respuesta = $response->json();
        $this->datos = $respuesta['productos'];

        $respuesta2 = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/CategoriasArbol');
        $this->categorias = collect($respuesta2->json()['categorias'] ?? []);

        $consulta = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarCategorias');
        $this->categoriasAll = $consulta->json()['categorias'];
    }

    public function updatedCategoria($categoria)
    {
        $this->sub_categoria = $this->categorias->firstWhere('id', $categoria)['subcategorias'] ?? [];
    }

    public function updatedSubcategoria($subcategoriaId)
    {
        // $this->sub_sub_categoria = $this->categorias->firstWhere('id', $sub_categoria)['sub_sub_categorias'] ?? [];
        $subcategoria = collect($this->sub_categoria)->firstWhere('id', $subcategoriaId);

        $this->sub_sub_categoria = is_array($subcategoria['sub_sub_categorias'] ?? null)
        ? $subcategoria['sub_sub_categorias']
        : [];
    }

    public $cat = "Todos";
    public function filtrarCategoria($categoriaNombre)
    {
        $this->obtenerdatos();
        $this->datos = collect($this->datos);
        $this->cat = $categoriaNombre;
        if ($categoriaNombre == 'Todos') {
            $productosFiltrados = $this->datos;
        } else {
            $productosFiltrados = $this->datos->filter(function ($producto) use ($categoriaNombre) {
                return $producto['categorias']['nombre'] == $categoriaNombre;
            });
        }

        $this->datos = $productosFiltrados;
    }

    //Mostrar Todos
    public function showAll()
    {
        $this->obtenerdatos();
        $this->filtro = 'Todos';
    }

    private function aplicarFiltro($productos)
    {
        $filtros = [
            'A - Z' => function ($producto) {
                return strtolower($producto['nm_producto']);
            },
            'Z - A' => function ($producto) {
                return strtolower($producto['nm_producto']);
            },
            'ANTIGUOS' => function ($producto) {
                return $producto['created_at'];
            },
            'RECIENTES' => function ($producto) {
                return $producto['created_at'];
            },
            'PRECIO MIN' => function ($producto) {
                return (float) $producto['precio'];
            },
            'PRECIO MAX' => function ($producto) {
                return (float) $producto['precio'];
            },
        ];

        // Si el filtro existe, aplicar el filtro correspondiente
        if (isset($filtros[$this->filtro])) {
            $productos = $productos->sortBy($filtros[$this->filtro]);

            // Si es un filtro descendente, usar sortByDesc
            if (in_array($this->filtro, ['Z - A', 'RECIENTES', 'PRECIO MAX'])) {
                $productos = $productos->sortByDesc($filtros[$this->filtro]);
            }
        }

        return $productos;
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
                'categorias_id' => $this->categoria,
                'sub_categorias_id' => $this->subcategoria,
                'sub_sub_categorias_id' => $this->subsubcategoria,
                'precio' => $this->precio,
                'descuento' => $this->descuento,
                'colores' => $cols,
                'stock' => $this->stock,
            ]);

            if ($response->successful()) {
                $this->reset(['nm_producto', 'descripcion', 'categoria', 'precio', 'descuento', 'colores', 'stock', 'imagen']);
                $this->obtenerdatos();

                $this->dispatch('correcto', 'Producto registrado con exito');
            } else {
                $this->dispatch('error', 'Error: '.$response->body());
            }
        } else {
            $this->dispatch('error', 'Por favor, sube una imagen.');
        }
    }

    public function editardatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->put($this->url.'/ActualizarProducto', [
            'id' => $this->id,
            'nm_producto' => $this->nm_producto,
            'descripcion' => $this->descripcion,
            'categoria' => $this->categoria,
            'precio' => $this->precio,
            'descuento' => $this->descuento,
            'colores' => $this->colorr,
            'stock' => $this->stock,
        ]);
        if ($response->successful()) {
            $this->verproducto($this->id);
            $this->dispatch('correcto', 'Datos actualizados correctamente');
        } else {
            $this->dispatch('error', 'error al actualizar datos');
        }
    }

    public function alertfalse()
    {
        $this->alert = false;
    }

    public function delete()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->delete($this->url.'/EliminarProducto='.$this->id);
        if ($response->successful()) {
            $this->dispatch('correcto', 'Producto eliminado con exito');
            $this->alert = true;
        } else {
            $this->dispatch('error', 'Error: '.$response->body());
        }
    }

    public function verproducto($id)
    {
        $this->id = $id;
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/Producto='.$this->id);
        $respuesta = $response->json();
        $this->data = $respuesta['producto'];
        $this->nm_producto = $this->data['nm_producto'];
        $this->descripcion = $this->data['descripcion'];
        $this->categoria = $this->data['categorias_id'];
        $this->precio = $this->data['precio'];
        $this->descuento = $this->data['descuento'];
        $this->colorr = $this->data['colores'];
        $this->stock = $this->data['stock'];
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
