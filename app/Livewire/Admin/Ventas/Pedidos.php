<?php

namespace App\Livewire\Admin\Ventas;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Pedidos extends Component
{
    public $url;

    public $datos;

    public $showdetalles = false;

    public $detalles;

    public $data;

    public $buscado = '';

    public function cargarDatos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarCarrito');
        $respuesta = $response->json();
        $this->data = collect($respuesta['carritos'] ?? [])
            ->filter(function ($item) {
                return $item['estado'] === 'Pagado' && $item['pagado'] !== 'Confirmado';
            })
            ->all();
        $this->datos = $this->data;
    }

    public function updatedBuscado()
    {
        if (empty($this->buscado)) {
            $this->cargarDatos();
        } else {
            $this->datos = collect($this->datos)->filter(function ($item) {
                return strpos($item['codigo_operacion'], $this->buscado) !== false && $item['estado'] === 'Pagado' && $item['pagado'] !== 'Confirmado';
            })->all();
        }
    }

    public function mostrarDetalles($id)
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarPedido='.$id);
        $respuesta = $response->json();
        $this->detalles = $respuesta['pedidos'];
        $this->showdetalles = true;
    }

    public function confirmarProductos($codigo){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->put($this->url.'/ConfirmarProductos',[
            "pagado" => "Confirmado",
            'codigo_operacion' => $codigo,
        ]);
        $respuesta = $response->json();

        if($response->successful()){
            $this->dispatch('correcto', 'Productos confirmados correctamnete');
            $this->showdetalles = false;
            $this->cargarDatos();
        } else {
            $this->showdetalles = false;
            $this->dispatch('error', 'Error no se puedo confirmar');
        }
    }

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatos();
    }

    public function render()
    {
        return view('livewire.admin.ventas.pedidos');
    }
}
