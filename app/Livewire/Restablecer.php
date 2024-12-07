<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Restablecer extends Component
{
    //ResetPassword
    public $dni;
    public $nombres;
    public $password;
    public $url;
    //funcion para vrestablecer contraseña
    public function restablecer(){
        $response = Http::withoutVerifying()->put($this->url . '/ResetPassword', [
            'dni' => $this->dni,
            'nombres' => $this->nombres,
            'password' => $this->password,
        ]);
        if ($response->successful()) {
            $exito = $response->json();
            $this->dispatch('correcto', $exito['mensaje']);
            Session::put('authToken', $exito['token']);
            return redirect()->route('/');
        } else {
            $error = $response->json()['error'];
            $this->dispatch('error', $error);
        }
    }
    public function mount(){
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
    }
    public function render()
    {
        return view('livewire.restablecer');
    }
}
