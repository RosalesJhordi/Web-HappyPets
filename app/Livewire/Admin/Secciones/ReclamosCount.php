<?php

namespace App\Livewire\Admin\Secciones;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ReclamosCount extends Component
{
    public $url;
    public $totalReclamos;

    public function totalMascotas()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/ListarReclamos');
        $this->totalReclamos = $response->json();
    }

    public function mount(){
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->totalMascotas();
    }
    public function render()
    {
        return view('livewire.admin.secciones.reclamos-count');
    }
}
