<?php

namespace App\Livewire\Admin\Libro;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Libros extends Component
{
    public $url;
    public $reclamos;
    public function reclamos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/ListarReclamos');
        $this->reclamos = $response->json();
    }

    public function mount(){
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->reclamos();
    }
    public function render()
    {
        return view('livewire.admin.libro.libros');
    }
}
