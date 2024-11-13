<?php

namespace App\Livewire\Admin\Servicios;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Inicio extends Component
{
    use WithFileUploads;

    public $url;

    public $datos;

    public $imagen;

    public $filtro = 'Todos';

    public $img = false;

    public $tipo;

    public $descripcion;

    public $buscado = '';

    public $ver;
    public $data;
    

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->obtenerdatos();
    }

    public function obtenerdatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarServicios');
        $respuesta = $response->json();
        $this->datos = $respuesta['servicios'];
    }

    public function addServicio()
    {
        if ($this->imagen) {
            $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->attach(
                'imagen',
                file_get_contents($this->imagen->getRealPath()),
                $this->imagen->getClientOriginalName()
            )->post($this->url.'/NuevoServicio', [
                'tipo' => $this->tipo,
                'descripcion' => $this->descripcion,
            ]);

            if ($response->successful()) {
                $this->reset(['tipo', 'descripcion', 'imagen']);
                $this->obtenerdatos();

                $this->dispatch('correcto', 'Servicio registrado exitosamente');
            } else {
                $this->dispatch('error', 'Error al registrar el servicio.');
            }
        } else {
            return back()->with('error', 'Por favor, sube una imagen.');
        }
    }

    public function verservicio($id)
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/Servicio='.$id);
        $respuesta = $response->json();
        $this->data = $respuesta['servicio'];
        $this->tipo = $this->data['tipo'];
        $this->descripcion = $this->data['descripcion'];
        $this->ver = true;
    }
    public function ocultar()
    {
        $this->ver = false;
        $this->obtenerdatos();
    }

    public function buscarServicios()
    {
        $productos = collect($this->datos);

        // Aplicar filtro si no es "Todos"
        if ($this->filtro !== 'Todos') {
            $productos = $this->aplicarFiltro($productos);
        }

        // Filtro de búsqueda por nombre
        if (! empty($this->buscado)) {
            $productos = $productos->filter(function ($producto) {
                return str_contains(strtolower($producto['tipo']), strtolower($this->buscado));
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

    private function aplicarFiltro($productos)
    {
        $filtros = [
            'A - Z' => function ($producto) {
                return strtolower($producto['tipo']);
            },
            'Z - A' => function ($producto) {
                return strtolower($producto['tipo']);
            },
            'ANTIGUOS' => function ($producto) {
                return $producto['created_at'];
            },
            'RECIENTES' => function ($producto) {
                return $producto['created_at'];
            },
        ];

        // Si el filtro existe, aplicar el filtro correspondiente
        if (isset($filtros[$this->filtro])) {
            $productos = $productos->sortBy($filtros[$this->filtro]);

            // Si es un filtro descendente, usar sortByDesc
            if (in_array($this->filtro, ['Z - A', 'RECIENTES'])) {
                $productos = $productos->sortByDesc($filtros[$this->filtro]);
            }
        }

        return $productos;
    }

    //filtro

    public function showAll()
    {
        $this->filtro = 'Todos';
        $this->obtenerdatos();
    }

    public function eliminar($id)
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->delete($this->url.'/EliminarServicio='.$id);
        dd($response->json());
        if ($response->successful()) {
            $this->dispatch('correcto', 'Servicio eliminado con exito');
            $this->obtenerdatos();
        } else {
            return back()->with('error', 'Error: '.$response->body());
        }
    }

    public function az()
    {
        $this->datos = collect($this->datos)->sortBy('tipo')->values()->toArray();
    }

    public function za()
    {
        $this->datos = collect($this->datos)->sortByDesc('tipo')->values()->toArray();
    }

    public function fechaup()
    {
        $this->datos = collect($this->datos)->sortBy('created_at')->values()->toArray();
    }

    public function fechadown()
    {
        $this->datos = collect($this->datos)->sortByDesc('created_at')->values()->toArray();
    }

    public function render()
    {
        $this->buscarServicios();

        return view('livewire.admin.servicios.inicio');
    }
}
