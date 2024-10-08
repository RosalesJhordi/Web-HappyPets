<?php

namespace App\Livewire\Admin\Productos;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Shows extends Component
{
    public $id;
    public $url = "https://api-happypetshco-com.preview-domain.com/api";
    public $datos;
    public function mount($id){
        $this->id = $id;
        $this->cargardatos();
    }
    public function cargardatos()
    {
        $response = Http::withoutVerifying()->get($this->url . '/BuscarProducto=' . $this->id);
        $respuesta = $response->json();
        $this->datos = $respuesta['producto'];
    }
    public function render()
    {
        return view('livewire.admin.productos.shows');
    }
}
