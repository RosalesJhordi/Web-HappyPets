<?php

namespace App\Livewire\Admin\Views;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Inicio extends Component
{
    public $url;

    public $datosClientes = [];

    public $datosEmpleados = [];

    public $data;

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        $response = Http::withOptions(['verify' => false])->get($this->url.'/Usuarios');
        $respuesta = $response->json();
        if ($response->successful()) {
            $this->data = $respuesta['usuarios'];
            $this->cargarClientes();
            $this->cargarEmpleados();
        }
    }

    public function cargarClientes()
    {
        $this->datosClientes = collect($this->data)
            ->filter(function ($usuario) {
                return in_array('Cliente', $usuario['permisos']) && count($usuario['permisos']) == 1;
            })
            ->sortByDesc('created_at') // Ordenar por fecha de creación de forma descendente
            ->values()
            ->toArray();
    }

    public function cargarEmpleados()
    {
        $empleadoPermisos = ['Cajero/Vendedor', 'Veterinario', 'Almacenero'];
        $this->datosEmpleados = collect($this->data)
            ->filter(function ($usuario) use ($empleadoPermisos) {
                return count(array_intersect($usuario['permisos'], $empleadoPermisos)) > 0;
            })
            ->sortByDesc('created_at') // Ordenar por fecha de creación de forma descendente
            ->values()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.admin.views.inicio');
    }
}
