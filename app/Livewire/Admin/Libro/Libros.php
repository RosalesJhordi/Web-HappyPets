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
        // Obtiene los reclamos desde la API
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url . '/ListarReclamos');
        $this->reclamos = $response->json();

        // Ordena los reclamos por la fecha de creación (suponiendo que el campo se llama 'created_at')
        $this->reclamos = collect($this->reclamos)->sortByDesc('created_at')->values()->toArray();
    }

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->reclamos();
    }

    public function render()
    {
        return view('livewire.admin.libro.libros');
    }
}
