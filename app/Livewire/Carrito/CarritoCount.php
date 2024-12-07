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

    public $contador = 0;

    public $importeTotal;

    public $precioActual;

    public $carritosIDS;

    public $datoPedidos;
    public $tickets;

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        if (Session::get('authToken')) {
            $this->datoss();
            $this->datosCarrito();
            $this->ListarPedido();
        }

    }

    public function eliminar($id){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->delete($this->url.'/EliminarCarrito='.$id);
        if ($response->successful()) {
            $this->datosCarrito();
        }
    }

    public function ListarPedido()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarPedido='.$this->id_usuario);

        if ($response->successful()) {
            $this->datoPedidos = collect($response->json()['pedidos']);
            $this->datoPedidos = $this->datoPedidos->sortByDesc(function ($pedido) {
                return $pedido['created_at'];
            });

            $this->datoPedidos = $this->datoPedidos->groupBy(function ($pedido) {
                return $pedido['producto']['nm_producto'].'-'.$pedido['codigo_operacion'];
            })->map(function ($items) {
                $cantidadTotal = $items->sum('cantidad');
                $firstItem = $items->first();
                $firstItem['cantidad'] = $cantidadTotal;

                return $firstItem;
            })->values();
        }
        $datoPedidosConfirmados = $this->datoPedidos->filter(function($pedido) {
            return $pedido['pagado'] === 'Confirmado';
        });
        $this->tickets = $datoPedidosConfirmados->groupBy('codigo_operacion')->map(function($items) {
            $totalImporte = $items->sum('importe'); // Suponiendo que 'importe' es el campo del total del pedido
            $firstItem = $items->first();
            $firstItem['importe'] = $totalImporte; // Asignamos el total al primer item del grupo
            $firstItem['cantidad'] = $items->sum('cantidad'); // Sumamos las cantidades
            return $firstItem;
        })->values();
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

            $this->datos = $agrupados->values();
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

    public function render()
    {
        return view('livewire.carrito.carrito-count');
    }
}
