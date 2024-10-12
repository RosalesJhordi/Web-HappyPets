<?php

namespace App\Livewire\Productos;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Show extends Component
{
    public $id_producto;
    public $url = "https://api-happypetshco-com.preview-domain.com/api";
    public $producto;
    public $productos;

    public function mount($id_producto){
        $this->id_producto = $id_producto;
        $this->producto();
        $this->productos();
    }
    public function producto(){
        $response = Http::withoutVerifying()->get($this->url. '/BuscarProducto='. $this->id_producto);
        if ($response->successful()) {
            $serv = $response->json();
            $this->producto = $serv['producto'];
        }else{
            return redirect()->back()->with('error', 'No se pudo obtener el servicio.');
        }
    }

    public function productos(){
        $response = Http::withoutVerifying()->get($this->url . '/ListarProductos');
        $respuesta = $response->json();
        $this->productos = $respuesta['productos'];
    }

    public function mostrar($id){
        $this->id_producto = $id;
        $this->producto();
    }
    public function render()
    {
        return view('livewire.productos.show');
    }
}
