<?php

namespace App\Livewire\Admin\Secciones;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ServiciosCount extends Component
{
    public $url;
    public $totalservicios;
    public function mount(){
        $this->url = env('API_URL', 'https://api-happypetshco-com.preview-domain.com/api');
        $this->totalservicios();
    }
    public function totalservicios(){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/ListarServicios');
        $respuesta = $response->json();
        $this->totalservicios = $respuesta['servicios'];
    }
    public function render()
    {
        return view('livewire.admin.secciones.servicios-count');
    }
}
