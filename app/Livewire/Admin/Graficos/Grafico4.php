<?php

namespace App\Livewire\Admin\Graficos;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Grafico4 extends Component
{
    public $url;

    public $data;

    public $datos;

    public $productosMasVendidos = [];

    public $citasEstadoFecha = [];
    public $citasTerminadas = [];
    public $citasCanceladas = [];
    public $citasPendientes = [];

    public $fechas = [];

    public function cargarDatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/TodasCitas');
        $respuesta = $response->json();
        $this->data = collect($respuesta['citas'] ?? [])->filter(function ($item) {
            return $item['estado'];
        })->all();
        $this->procesarDatos();
        $this->procesarFechas();
    }

    public function procesarDatos() {
        // Agrupar citas por estado
        $this->citasTerminadas = collect($this->data)->filter(function ($cita) {
            return $cita['estado'] === 'Terminado';
        })->groupBy(function($date) {
            return \Carbon\Carbon::parse($date['created_at'])->format('Y-m-d');
        })->map->count()->toArray();

        $this->citasCanceladas = collect($this->data)->filter(function ($cita) {
            return $cita['estado'] === 'Cancelado';
        })->groupBy(function($date) {
            return \Carbon\Carbon::parse($date['created_at'])->format('Y-m-d');
        })->map->count()->toArray();

        $this->citasPendientes = collect($this->data)->filter(function ($cita) {
            return $cita['estado'] === 'Pendiente';
        })->groupBy(function($date) {
            return \Carbon\Carbon::parse($date['created_at'])->format('Y-m-d');
        })->map->count()->toArray();
    }


    public function procesarFechas()
    {
        $this->fechas = collect($this->data)->map(function ($cita) {
            return ['fecha' => $cita['created_at'], 'estado' => $cita['estado']];
        })->toArray();
    }

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatos();
    }

    public function render()
    {
        return view('livewire.admin.graficos.grafico4');
    }
}
