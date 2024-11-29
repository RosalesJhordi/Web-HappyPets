<?php

namespace App\Livewire\Admin\Secciones;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Ganancias extends Component
{
    public $url;

    public $totalproductos = [];

    public $totalImporte;

    public function totalProd()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarCarrito');
        $respuesta = $response->json();
        $this->totalproductos = collect($respuesta['carritos'] ?? [])->filter(function ($item) {
            return $item['estado'] === 'Pagado' && $item['pagado'] === 'Confirmado';
        })->all();
        $this->totalImporte = collect($this->totalproductos)->sum('importe');
    }

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->totalProd();
    }

    public function render()
    {
        return view('livewire.admin.secciones.ganancias');
    }
}
