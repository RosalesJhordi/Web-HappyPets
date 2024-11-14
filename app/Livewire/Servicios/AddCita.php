<?php

namespace App\Livewire\Servicios;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class AddCita extends Component
{
    public $url;
    public $id_servicio;
    public $step = 0;
    public $id_user;
    public $mascotas;
    public function mount($id){
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->id_servicio = $id;

        if(Session::get('authToken')){
            $this->cargarDatosUsuario();
            $this->obtenerMascotas();
        }
    }
    public function obtenerMascotas(){
        // Obtener las mascotas del usuario
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->
        get($this->url . '/MascotasUsuario='.$this->id_user);
        $respuesta = $response->json()['mascotas'];
        $this->mascotas = $respuesta;
    }
    public function cargarDatosUsuario(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/Datos');

        if ($response->successful()) {
            $data = $response->json();
            $this->id_user = $data['usuarios']['id'];
        }
    }
    public function nextStep()
    {
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }
    public function render()
    {
        return view('livewire.servicios.add-cita');
    }
}
