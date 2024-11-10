<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class ChatBot extends Component
{
    public $message = '';
    public $responses = [];
    public $output;
    public $url;
    public $nombres;
    public $apellidos;

    public function cargarDatosUsuario()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url.'/Datos');

        if ($response->successful()) {
            $data = $response->json();
            $this->nombres = $data['usuarios']['nombres'];
            $this->apellidos = $data['usuarios']['apellidos'] ?? '';
        }
    }

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatosUsuario();
    }

    public function sendMessage()
    {
        // Si apellidos está vacío, pasar una cadena vacía
        if (empty($this->apellidos)) {
            $this->apellidos = '';
        }

        $pythonScriptPath = base_path('01.py');
        $arg1 = $this->nombres;
        $arg2 = $this->apellidos;

        // Ejecutar el script Python con los dos argumentos
        $output = shell_exec('python3 '.escapeshellarg($pythonScriptPath).' '.escapeshellarg($arg1).' '.escapeshellarg($arg2));

        // Guardar la salida para mostrarla
        $this->output = $output;
    }

    public function render()
    {
        return view('livewire.chat-bot');
    }
}
