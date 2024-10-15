<?php

namespace App\Livewire\Carrito;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ShowCarrito extends Component
{
    public $url;
    public $id_usuario;
    public $datos;
    public $importeTotal;

    public function mount(){
        $this->url = env('API_URL', '');
        $this->datos();
        $this->mostrar();
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
    public function mostrar(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/ListarCarrito='. $this->id_usuario);

        if ($response->successful()) {
            $data = $response->json();
            $this->datos = $data['carrito'];
            $this->importeTotal = collect($this->datos)->sum('importe');
        }
    }
    public function render()
    {
        return view('livewire.carrito.show-carrito');
    }
}
