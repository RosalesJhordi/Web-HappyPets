<?php

namespace App\Livewire\Admin\Secciones;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MascotasCount extends Component
{
    public $url = "https://api-happypetshco-com.preview-domain.com/api";
    public $totalMascotas;

    public function totalMascotas()
    {
        $response = Http::withoutVerifying()->get($this->url . '/ListarMascotas');
        $respuesta = $response->json();
        $this->totalMascotas = $respuesta['mascotas'];
    }

    public function mount(){
        $this->totalMascotas();
    }
    public function render()
    {
        return view('livewire.admin.secciones.mascotas-count');
    }
}
