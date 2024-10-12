<?php

namespace App\Livewire\Carrito;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CarritoCount extends Component
{
    public $url = "https://api-happypetshco-com.preview-domain.com/api";
    public $id_usuario;
    public $datos;
    public function mount(){
        $this->datos();
        $this->datosCarrito();
    }
    public function datos(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/DatosUsuario');

        if ($response->successful()) {
            $data = $response->json();
            $this->id_usuario = $data['usuarios']['id'];
        }
    }
    public function datosCarrito(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/ListarCarrito=' . $this->id_usuario);

        if ($response->successful()) {
            $data = $response->json();
            $this->datos = $data['carrito'];
        }
    }
    public function render()
    {
        return view('livewire.carrito.carrito-count');
    }
}
