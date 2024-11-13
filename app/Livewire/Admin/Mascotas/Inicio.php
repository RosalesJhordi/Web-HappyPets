<?php

namespace App\Livewire\Admin\Mascotas;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Inicio extends Component
{
    use WithFileUploads;

    public $url;

    public $datos;

    public $filtro = 'Todos';

    public $buscado = '';

    public $historial;
    public $verHistorial = false;

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->obtenerdatos();
    }

    public function ver($id){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/HistorialMascota='.$id);
        $respuesta = $response->json();

        //si la respuesta es correcta
        if ($response->successful()) {
            $this->historial = $respuesta;
            $this->verHistorial = true;
        } else {
            $this->dispatch('error', 'Error: '.$response->body());
        }
    }

    public function ocultarHistorial(){
        $this->verHistorial = false;
    }

    public function updatedbuscado()
    {
        $this->obtenerdatos();
    }

    public function obtenerdatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/TodasMascotas');
        $respuesta = $response->json();
        $this->datos = $respuesta['mascotas'];
    }

    public function buscarMascota()
    {
        $mascotas = collect($this->datos);

        // Aplicar filtro si no es "Todos"
        if ($this->filtro !== 'Todos') {
            switch ($this->filtro) {
                case 'A - Z':
                    $mascotas = $mascotas->sortBy(function ($producto) {
                        return strtolower($producto['nombre']);
                    });
                    break;
                case 'Z - A':
                    $mascotas = $mascotas->sortByDesc(function ($producto) {
                        return strtolower($producto['nombre']);
                    });
                    break;
                case 'ANTIGUOS':
                    $mascotas = $mascotas->sortBy(function ($producto) {
                        return $producto['created_at'];
                    });
                    break;
                case 'RECIENTES':
                    $mascotas = $mascotas->sortByDesc(function ($producto) {
                        return $producto['created_at'];
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
        } elseif (! empty($this->buscado)) {
            $mascotas = $mascotas->filter(function ($producto) {
                return str_contains(strtolower($producto['nombre']), strtolower($this->buscado));
            });
        } else {
            $this->showAll();
        }

        $this->datos = $mascotas->values()->all();
    }

    //filtro

    public function showAll()
    {
        $this->filtro = 'Todos';
        $this->obtenerdatos();
    }

    public function az()
    {
        $this->datos = collect($this->datos)->sortBy('nombre')->values()->toArray();
    }

    public function za()
    {
        $this->datos = collect($this->datos)->sortByDesc('nombre')->values()->toArray();
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
        $this->buscarMascota();

        return view('livewire.admin.mascotas.inicio');
    }
}
