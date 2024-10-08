<?php

namespace App\Livewire\Admin\Views;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Inicio extends Component
{
    public $url = "https://api-happypetshco-com.preview-domain.com/api";
    public $totaluser;
    public $totalproductos;

    public function mount(){
        $this->users();
        $this->totalProd();
    }
    public function users(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '. Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url. '/Usuarios');
        $respuesta = $response->json();
        $this->totaluser = $respuesta['usuarios'];
    }
    public function totalProd(){
        $response = Http::withoutVerifying()->get($this->url . '/ListarProductos');
        $respuesta = $response->json();
        $this->totalproductos = $respuesta['productos'];
    }
    public function render()
    {
        return view('livewire.admin.views.inicio');
    }
}
