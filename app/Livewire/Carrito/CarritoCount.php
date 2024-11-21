<?php

namespace App\Livewire\Carrito;

use Barryvdh\DomPDF\Facade\Pdf;
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

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        if (Session::get('authToken')) {
            $this->datoss();
            $this->datosCarrito();
        }

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

    public $factura;

    public $cliente = 'Jhon Rosales';

    public $direccion = 'Calle 123, Colonia Centro, Ciudad de México';

    public $telefono = '555-1234-5678';

    public $email = 'john.rosales@example.com';

    public $descripcion = 'Gaaaaaaaaaaaa';

    public $total = 2000;

    public $subtotal = 2000;

    public $impuesto = 16;

    public function Factura()
{
    $html = '
    <html>
    <head>
        <meta charset="UTF-8"> <!-- Asegúrate de incluir esto -->
        <title>Factura</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
            }
            .factura-header {
                text-align: center;
                margin-bottom: 30px;
            }
            .factura-header h1 {
                margin: 0;
                font-size: 24px;
            }
            .factura-header p {
                margin: 0;
                font-size: 14px;
            }
            .factura-body {
                margin-bottom: 30px;
            }
            .factura-body table {
                width: 100%;
                border-collapse: collapse;
            }
            .factura-body th, .factura-body td {
                border: 1px solid #000;
                padding: 8px;
                text-align: left;
            }
            .factura-footer {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <div class="factura-header">
            <h1>Factura</h1>
            <p>Emitida por: Mi Empresa</p>
            <p>Fecha: '.date('Y-m-d').'</p>
        </div>

        <div class="factura-body">
            <p><strong>Cliente:</strong> '.$this->cliente.'</p>
            <p><strong>Descripción:</strong> '.$this->descripcion.'</p>

            <table>
                <thead>
                    <tr>
                        <th>Cantidad</th>
                        <th>Descripción</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>'.$this->descripcion.'</td>
                        <td>$'.number_format($this->subtotal, 2).'</td>
                        <td>$'.number_format($this->subtotal, 2).'</td>
                    </tr>
                </tbody>
            </table>

            <table style="margin-top: 20px;">
                <tr>
                    <td><strong>Subtotal:</strong></td>
                    <td>$'.number_format($this->subtotal, 2).'</td>
                </tr>
                <tr>
                    <td><strong>IVA (16%):</strong></td>
                    <td>$'.number_format($this->impuesto, 2).'</td>
                </tr>
                <tr>
                    <td><strong>Total:</strong></td>
                    <td>$'.number_format($this->total, 2).'</td>
                </tr>
            </table>
        </div>

        <div class="factura-footer">
            <p>Gracias por tu compra.</p>
        </div>
    </body>
    </html>
    ';

    // Convertir el contenido a UTF-8
    $html = mb_convert_encoding($html, 'UTF-8', 'auto');

    // Crear el PDF desde el HTML generado
    $pdf = PDF::loadHTML($html)->setOption('font', 'DejaVu Sans');


    // Mostrar el PDF en el navegador
    return $pdf->stream('factura.pdf');
}


    public function render()
    {
        return view('livewire.carrito.carrito-count');
    }
}
