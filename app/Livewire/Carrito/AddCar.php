<?php

namespace App\Livewire\Carrito;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AddCar extends Component
{
    public $url;
    public $id_usuario;
    public $cantidad = 0;
    public $nombre;
    public $id;
    public $importe;
    public $total;
    public $color;
    public $descuento;
    public $colores = [];
    public $descripcion;
    public $imagen;
    public function mount($nombre,$imagen,$id,$descuento,$importe,$descripcion,$colores){
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->nombre = $nombre;
        $this->imagen = $imagen;
        $this->id = $id;
        $this->descuento = $descuento;
        $this->importe = $importe;
        $this->descripcion = $descripcion;
        $this->colores = explode(',', $colores);
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

        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->post($this->url . '/AgregarCarrito', [
            'cantidad' => $this->cantidad,
            'color' => $this->color,
            'importe' => $this->total,
            'id_producto' => $this->id,
            'id_usuario' => $this->id_usuario
        ]);
        //dd($this->cantidad, $this->id_usuario, $this->color, $this->importe, $this->id,$this->total);
        if ($response->successful()) {
            return back()->with('mensaje', 'Producto agregado exitosamente');
            return redirect()->route('Productos');
        } else {
            return back()->with('error', "Error: " . $response->body());
        }
    }
    public function datos(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/Datos');

        if ($response->successful()) {
            $data = $response->json();
            $this->id_usuario = $data['usuarios']['id'];
        }
    }
    public function calculartotal(){
        if ($this->descuento) {
            $this->total = $this->cantidad * ($this->importe - ($this->importe * $this->descuento) / 100);
        } else {
            $this->total = $this->cantidad * $this->importe;
        }
    }

    public function actualizarcolor($color){
        $this->color = $color;
    }
    public function render()
    {
        return view('livewire.carrito.add-car');
    }
}
