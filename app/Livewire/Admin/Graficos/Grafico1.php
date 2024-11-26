<?php

namespace App\Livewire\Admin\Graficos;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Grafico1 extends Component
{
    public $url;

    public $data;

    public $datos;

    public $importesPorDia = [];

    public function cargarDatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarCarrito');
        $respuesta = $response->json();
        $this->data = collect($respuesta['carritos'] ?? [])->filter(function ($item) {
            return $item['estado'] === 'Pagado' && $item['pagado'] === 'Confirmado';
        })->all();
        $this->procesarDatos();
    }

    public function procesarDatos()
    {
        $currentMonth = Carbon::now()->format('m-Y');
        $this->importesPorDia = collect($this->data)
            ->filter(function ($item) use ($currentMonth) {
                return Carbon::parse($item['updated_at'])->format('m-Y') === $currentMonth;
            })
            ->groupBy(function ($item) {
                return Carbon::parse($item['updated_at'])->format('d');
            })
            ->map(function ($dayData) {
                return round($dayData->sum(function ($item) {
                    return (float) ($item['importe'] ?? 0);
                }), 2);
            })->toArray();

    }

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatos();
    }

    public function render()
    {
        return view('livewire.admin.graficos.grafico1');
    }
}
