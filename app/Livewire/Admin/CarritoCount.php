<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CarritoCount extends Component
{
    public $datosCarrito;
    public $carritosIDS;
    public $precioActual;
    public $importeTotal;
    public $totalCarrito;
    public $url;
    public function datosCarrito(){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->withOptions([
            'verify' => false,
        ])->get($this->url.'/MostrarCarrito='. 4);

        if ($response->successful()) {
            $data = $response->json();
            $carrito = $data['carrito'];
            $carrito = collect($carrito)->filter(function ($item) {
                return $item['estado'] === 'Pendiente';
            });

            $this->carritosIDS = collect($carrito)->pluck('id')->toArray();

            $agrupados = collect($carrito)->groupBy(function ($item) {
                return $item['producto']['nm_producto'];
            })->map(function ($productos, $nombreProducto) {
                $id = $productos->first()['id'];
                $cantidadTotal = $productos->sum('cantidad');
                $importeTotal = $productos->sum('importe');
                $colores = $productos->pluck('color')->unique()->implode(', ');
                $imagen = $productos->first()['producto']['imagen'];
                $categoria = $productos->first()['producto']['categorias_id'];
                $descuento = $productos->first()['producto']['descuento'];
                $this->precioActual = $productos->first()['producto']['precio'];

                return [
                    'id' => $id,
                    'nombre' => $nombreProducto,
                    'cantidad' => $cantidadTotal,
                    'colores' => $colores,
                    'importe' => $importeTotal,
                    'imagen' => $imagen,
                    'productoPrecio' => $this->precioActual,
                    'categoria' => $categoria,
                ];
            });

            $this->datosCarrito = $agrupados->values();
            $this->importeTotal = $agrupados->sum('importe');
        }
    }

    public $metodoSeleccionado = 'Efectivo';

    public function seleccionarMetodo($metodo)
    {
        $this->metodoSeleccionado = $metodo;
    }

    public function ConfirmarProductos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->withOptions([
            'verify' => false,
        ])->put($this->url.'/ConfirmarPedido', [
            'carritos' => $this->carritosIDS,
            'estado' => 'Pagado',
            'tipo_pago' => $this->metodoSeleccionado,
        ]);
        if ($response->successful()) {
            $this->datosCarrito();
            $this->dispatch('correcto', 'Productos confirmados');
        } else {
            $this->datosCarrito();
            $this->dispatch('error', 'Error al confirmar productos');
        }
    }
    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->datosCarrito();
    }
    public function aumentar($id, $cantidad, $precio)
    {
        $total = $cantidad * $precio;
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->put($this->url.'/ActualizarCarrito='.$id, [
            'cantidad' => $cantidad,
            'importe' => $total,
        ]);
        if ($response->successful()) {
            $this->datosCarrito();
        } else {
            $this->datosCarrito();
        }
    }

    public function disminuir($id, $cantidad, $precio)
    {
        $total = $cantidad * $precio;
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->put($this->url.'/ActualizarCarrito='.$id, [
            'cantidad' => $cantidad,
            'importe' => $total,
        ]);
        if ($response->successful()) {
            $this->datosCarrito();
        } else {
            $this->datosCarrito();
        }
    }
    public function render()
    {
        return view('livewire.admin.carrito-count');
    }
}
