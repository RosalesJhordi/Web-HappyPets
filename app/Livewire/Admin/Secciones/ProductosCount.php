<?php

namespace App\Livewire\Admin\Secciones;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ProductosCount extends Component
{
    public $url = "https://api-happypetshco-com.preview-domain.com/api";
    public $totalproductos = [];

    public function totalProd()
    {
        $response = Http::withoutVerifying()->get($this->url . '/ListarProductos');
        $respuesta = $response->json();
        $this->totalproductos = $respuesta['productos'] ?? [];
    }

    public function mount(){
        $this->totalProd();
    }
    public function render()
    {
        return view('livewire.admin.secciones.productos-count');
    }
}
