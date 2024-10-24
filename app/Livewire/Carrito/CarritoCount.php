<?php

namespace App\Livewire\Carrito;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CarritoCount extends Component
{
    public $url;

    public $id_usuario;

    public $datos;

    public $importeTotal;

    public function mount()
    {
        $this->url = env('API_URL', 'https://api-happypetshco-com.preview-domain.com/api');
        if (Session::get('authToken')) {

            $this->datoss();
            $this->datosCarrito();
        }

    }

    public function datoss()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url.'/Datos');

        if ($response->successful()) {
            $data = $response->json();
            $this->id_usuario = $data['usuarios']['id'];
        }
    }

    public function datosCarrito()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->withOptions([
            'verify' => false,
        ])->get($this->url.'/MostrarCarrito='.$this->id_usuario);

        if ($response->successful()) {
            $data = $response->json();
            $carrito = $data['carrito'];

            // Agrupar productos por nombre y sumar cantidades e importes
            $agrupados = collect($carrito)->groupBy(function ($item) {
                return $item['producto']['nm_producto'];
            })->map(function ($productos, $nombreProducto) {
                $cantidadTotal = $productos->sum('cantidad');
                $importeTotal = $productos->sum('importe');
                $colores = $productos->pluck('color')->unique()->implode(', ');
                $imagen = $productos->first()['producto']['imagen'];
                $categoria = $productos->first()['producto']['categoria'];
                $descuento = $productos->first()['producto']['descuento'];

                return [
                    'nombre' => $nombreProducto,
                    'cantidad' => $cantidadTotal,
                    'colores' => $colores,
                    'importe' => $importeTotal,
                    'imagen' => $imagen,
                    'categoria' => $categoria,
                ];
            });

            $this->datos = $agrupados->values();
            $this->importeTotal = $agrupados->sum('importe');
        }
    }

    public function render()
    {
        return view('livewire.carrito.carrito-count');
    }
}
