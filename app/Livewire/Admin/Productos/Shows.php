<?php

namespace App\Livewire\Admin\Productos;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Url;
use Livewire\Component;

class Shows extends Component
{
    public $id;
    public $url;
    public $datos;
    public $nm_producto;
    public $descripcion;
    public $categoria;
    public $precio;
    public $descuento;
    public $stock;
    public $alert = false;
    public $colores;

    public function mount($id)
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->id = $id;
        $this->cargardatos();
    }
    public function cargardatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/Producto=' . $this->id);
        $respuesta = $response->json();
        $this->datos = $respuesta['producto'];
        $this->nm_producto = $this->datos['nm_producto'];
        $this->descripcion = $this->datos['descripcion'];
        $this->categoria = $this->datos['categoria'];
        $this->precio = $this->datos['precio'];
        $this->descuento = $this->datos['descuento'];
        $this->colores = $this->datos['colores'];
        $this->stock = $this->datos['stock'];
    }

    public function editardatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->put($this->url . '/ActualizarProducto', [
            'id' => $this->id,
            'nm_producto' => $this->nm_producto,
            'descripcion' => $this->descripcion,
            'categoria' => $this->categoria,
            'precio' => $this->precio,
            'descuento' => $this->descuento,
            'colores' => $this->colores,
            'stock' => $this->stock,
        ]);
        if ($response->successful()) {
            $this->cargardatos();
            session()->flash('success','Datos actualizados correctamente');
            $this->alert = true;
        } else {
            return back()->with('error', "Error: " . $response->body());
        }
    }
    public function alertfalse(){
        $this->alert = false;
    }
    public function delete(){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/EliminarProducto=' . $this->id);
        if ($response->successful()) {
            session()->flash('success','Producto eliminado con exito');
            $this->alert = true;
        } else {
            return back()->with('error', "Error: " . $response->body());
        }
    }
    public function render()
    {
        return view('livewire.admin.productos.shows');
    }
}
