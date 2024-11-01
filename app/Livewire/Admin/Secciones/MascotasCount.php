<?php

namespace App\Livewire\Admin\Secciones;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class MascotasCount extends Component
{
    public $url;
    public $totalMascotas;

    public function totalMascotas()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/TodasMascotas');
        $respuesta = $response->json();
        $this->totalMascotas = $respuesta['mascotas'];
    }

    public function mount(){
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->totalMascotas();
    }
    public function render()
    {
        return view('livewire.admin.secciones.mascotas-count');
    }
}
