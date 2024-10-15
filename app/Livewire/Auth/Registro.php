<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Registro extends Component
{
    public $dni;
    public $dni2;
    public $telefono;
    public $password;
    public $password_confirmation;
    public $remember = false;
    public $url;

    public $error;
    public $exito;

    public $mostrar = true;

    public function mount(){
        $this->url = env('API_URL', '');
    }

    public function registro()
    {
        $response = Http::withoutVerifying()->post($this->url . '/Registro', [
            'dni' => $this->dni,
            'telefono' => $this->telefono,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);
        if ($response->successful()) {
            $this->exito = $response->json();
            Session::put('authToken', $this->exito['token']);
            return redirect()->route('/');
        } else {
            $this->error = $response->json();
        }
    }

    public function login(){
        $response = Http::withoutVerifying()->post($this->url . '/Autenticar',[
            'dni' => $this->dni2,
            'password' => $this->password
        ]);
        if ($response->successful()) {
            $this->exito = $response->json();
            Session::put('authToken', $this->exito['token']);
            return redirect()->route('/');
        } else {
            $this->error = $response->json();
        }
    }

    public function mostrardiv2()
    {
        $this->mostrar = false;
    }

    public function mostrardiv1()
    {
        $this->mostrar = true;
    }
    public function render()
    {
        return view('livewire.auth.registro');
    }
}
