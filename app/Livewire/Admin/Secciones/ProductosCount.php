<?php

namespace App\Livewire\Admin\Secciones;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ProductosCount extends Component
{
    public $url;
    public $totalproductos = [];

    public function totalProd()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/ListarProductos');
        $respuesta = $response->json();
        $this->totalproductos = $respuesta['productos'] ?? [];
    }

    public function mount(){
        $this->url = env('API_URL', '');
        $this->totalProd();
    }
    public function render()
    {
        return view('livewire.admin.secciones.productos-count');
    }
}
