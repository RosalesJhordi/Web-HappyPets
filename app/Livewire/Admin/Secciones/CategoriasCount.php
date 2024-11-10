<?php

namespace App\Livewire\Admin\Secciones;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CategoriasCount extends Component
{
    public $url;
    public $totalCategorias;

    public function totalMascotas()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/ListarCategorias');
        $respuesta = $response->json();
        $this->totalCategorias = $respuesta['categorias'];
    }

    public function mount(){
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->totalMascotas();
    }
    public function render()
    {
        return view('livewire.admin.secciones.categorias-count');
    }
}
