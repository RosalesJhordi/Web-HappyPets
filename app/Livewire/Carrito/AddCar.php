<?php

namespace App\Livewire\Carrito;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AddCar extends Component
{
    public $url = "https://api-happypetshco-com.preview-domain.com/api";
    public $id_usuario;
    public $cantidad = 0;
    public $nombre;
    public $id;
    public $importe;
    public $total;
    public $color;
    public function mount($nombre,$id,$importe){
        $this->nombre = $nombre;
        $this->id = $id;
        $this->importe = $importe;
    }
    public function incrementar(){
        $this->cantidad++;
        $this->calculartotal();
        $this->datos();
    }
    public function decrementar(){
        if ($this->cantidad == 0) {
            
        }else{
            $this->cantidad--;
            $this->calculartotal();
        }
    }

    public function agregarCarrito(){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->post($this->url . '/AñadirCarrito', [
            'cantidad' => $this->cantidad,
            'color' => $this->color,
            'importe' => $this->total,
            'id_producto' => $this->id,
            'id_usuario' => $this->id_usuario
        ]);

        if ($response->successful()) {
            return back()->with('mensaje', 'Servicio registrado exitosamente');
        } else {
            return back()->with('error', "Error: " . $response->body());
        }
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
    public function calculartotal(){
        $this->total = $this->cantidad * $this->importe;
    }
    public function render()
    {
        return view('livewire.carrito.add-car');
    }
}
