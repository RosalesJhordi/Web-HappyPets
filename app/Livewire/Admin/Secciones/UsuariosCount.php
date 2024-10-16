<?php

namespace App\Livewire\Admin\Secciones;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class UsuariosCount extends Component
{
    public $url;
    public $totaluser;

    public function mount(){
        $this->url = env("API_URL", "https://api-happypetshco-com.preview-domain.com/api");
        $this->users();
    }
    public function users(){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->withOptions([
            'verify' => false,
        ])->get($this->url. '/Usuarios');
        $respuesta = $response->json();
        $this->totaluser = $respuesta['usuarios'];
    }

    public function render()
    {
        return view('livewire.admin.secciones.usuarios-count');
    }
}
