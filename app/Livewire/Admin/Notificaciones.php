<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Notificaciones extends Component
{
    public $url;
    public $datosCarrito = [];
    public $id;
    public $permisos;
    public $NotiPedido = [];
    public $NotiCita = [];
    public $NotiNovedad = [];
    public $NotiPedidoAll = [];
    public $NotiCitasAll = [];
    public $NotiNovedades = [];

    public function cargarDatosUsuario()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/Datos');

        if ($response->successful()) {
            $data = $response->json();
            $this->id = $data['usuarios']['id'] ?? 0;
            $this->permisos = $data['usuarios']['permisos'] ?? [];
        }

        $this->cargarNotificaciones();
    }

    public function NotiPedido()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/NotiPedido=' . $this->id);

        if ($response->successful()) {
            $notificaciones = $response->json()['notificaciones'];
            $this->NotiPedido = $notificaciones;
            $this->datosCarrito = array_merge($this->datosCarrito, $notificaciones);
        }
    }
    public function NotiPedidoAll(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/NotiPedidoAll=' . $this->id);

        if ($response->successful()) {
            $notificaciones = $response->json()['notificaciones'];
            $this->NotiPedidoAll = $notificaciones;
        }
    }
    public function cargarNotificaciones()
    {
        if (in_array('Administrador', $this->permisos)) {
            $this->NotiPedido();
            $this->NotiCitas();
            $this->NotiNovedades();
            $this->NotiPedidoAll();
            $this->NotiCitasAll();
            $this->NotiPedidoAll();
            $this->NotiCitasAll();
            $this->NotiNovedadesAll();
        } elseif (in_array('Cajero/Vendedor', $this->permisos)) {
            $this->NotiPedido();
            $this->NotiPedidoAll();
        } elseif (in_array('Veterinario', $this->permisos)) {
            $this->NotiCitas();
            $this->NotiCitasAll();
        } else {
            $this->NotiNovedades();
            $this->NotiNovedadesAll();
        }
    }

    public function NotiCitas()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/NotiCita=' . $this->id);

        if ($response->successful()) {
            $notificaciones = $response->json()['notificaciones'];
            $this->NotiCita = $notificaciones;
            $this->datosCarrito = array_merge($this->datosCarrito, $notificaciones);
        }
    }

    public function NotiCitasAll(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/NotiCitaAll=' . $this->id);

        if ($response->successful()) {
            $notificaciones = $response->json()['notificaciones'];
            $this->NotiCitasAll = $notificaciones;
        }
    }

    public function NotiNovedades()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/NotiNovedades=' . $this->id);

        if ($response->successful()) {
            $notificaciones = $response->json()['notificaciones'];
            $this->NotiNovedad= $notificaciones;
            $this->datosCarrito = array_merge($this->datosCarrito, $notificaciones);
        }
    }

    public function NotiNovedadesAll(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url . '/NotiNovedadesAll=' . $this->id);

        if ($response->successful()) {
            $notificaciones = $response->json()['notificaciones'];
            $this->NotiNovedades = $notificaciones;
        }
    }

    public function MarcarLeidoPedidio($id){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Session::get('authToken'),
        ])->withOptions([
           'verify' => false,
        ])->get($this->url.'/NotiPedidoUpdate='.$id."=".$this->id);
        if($response->successful()){
            $this->cargarNotificaciones();
        }
    }

    public function MarcarLeidoCitas($id){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Session::get('authToken'),
        ])->withOptions([
           'verify' => false,
        ])->get($this->url.'/NotiCitaUp='.$id."=".$this->id);
        if($response->successful()){
            $this->cargarNotificaciones();
        }
    }

    public function MarcarLeidoNovedades($id){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Session::get('authToken'),
        ])->withOptions([
           'verify' => false,
        ])->get($this->url.'/NotiNovedadesUpdate='.$id."=".$this->id);
        if($response->successful()){
            $this->cargarNotificaciones();
        }
    }

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        if(Session::get('authToken')){
            $this->cargarDatosUsuario();
        }

    }

    public function render()
    {
        return view('livewire.admin.notificaciones');
    }
}
