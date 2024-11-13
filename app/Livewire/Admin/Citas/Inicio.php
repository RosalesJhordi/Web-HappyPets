<?php

namespace App\Livewire\Admin\Citas;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Inicio extends Component
{
    public $mesActual;

    public $anioActual;

    public $eventos = [];

    public $currentYear;

    public $currentMonth;

    public $url;

    public $detalles = false;

    public $fech;

    public $citas;

    public $detallesCita = false;

    public $citadetalles;

    public $estado_cita;
    public $observaciones_cita;
    public $importe_cita;
    public $proxima_cita;
    public $evaluaciones_cita;
    public $horas_hospedaje;
    public $dias_internado;
    public $tratamiento_cita;
    public $resultados;
    public $imagen;

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');

        date_default_timezone_set('America/Lima');

        $this->mesActual = now()->month;
        $this->anioActual = now()->year;
        $this->currentYear = $this->anioActual;
        $this->currentMonth = $this->mesActual;
        $this->cargarEventos();
    }

    public function diaa($dia, $mes, $año)
    {
        $fecha = Carbon::create($año, $mes, $dia);
        $this->fech = $fecha->format('d/m/Y');
        $this->detalles = true;
        $this->cargarEventos();

        $this->citas = collect($this->eventos)->filter(function ($cita) {
            return $cita['fecha'] === $this->fech;
        })->sortBy(function ($cita) {
            return $cita['estado'] === 'Pendiente' ? 0 : 1;
        });
    }

    public function detallescita($id)
    {
        $this->cargarEventos();
        $this->detallesCita = true;
        $this->citadetalles = collect($this->eventos)->filter(function ($cita) use ($id) {
            return $cita['id'] === $id;
        })->first();
    }

    public function guardarCambios($id)
{
    // Formatear la fecha si se ha proporcionado
    $fechaFormateada = $this->proxima_cita ? Carbon::parse($this->proxima_cita)->format('Y-m-d') : null;

    // Crear el array solo con los campos que tienen datos
    $data = array_filter([
        'estado' => $this->estado_cita,
        'observaciones' => $this->observaciones_cita,
        'importe' => $this->importe_cita,
        'evaluaciones' => $this->evaluaciones_cita,
        'horas_hospedaje' => $this->horas_hospedaje,
        'dias_internado' => $this->dias_internado,
        'tratamiento' => $this->tratamiento_cita,
        'resultados' => $this->resultados,
        'proxima_cita' => $fechaFormateada,
    ], function ($value) {
        return !is_null($value);
    });

    // Enviar la imagen si está presente, o solo el resto de datos
    if ($this->imagen) {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->attach(
            'imagenes_lab',
            file_get_contents($this->imagen->getRealPath()),
            $this->imagen->getClientOriginalName()
        )->put($this->url.'/ActualizarCita/'.$id, $data);
    } else {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->put($this->url.'/ActualizarCita/'.$id, $data);
    }

    // Manejar la respuesta del servidor
    if ($response->successful()) {
        $this->detallescita($id);
        $this->dispatch('correcto', 'Cita actualizada con éxito');
    } else {
        $this->dispatch('error', 'Error al actualizar cita. Código: '.$response->status());
    }
}


    public function ocultar()
    {
        $this->detallesCita = false;
    }

    public function ocultarDetalles()
    {
        $this->detalles = false;
    }

    public function cargarEventos()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/TodasCitas');
        $respuesta = $response->json();

        $this->eventos = $respuesta['citas'];
    }

    // Método para retroceder al mes anterior
    public function mesAnterior()
    {
        if ($this->currentMonth == 1) {
            $this->currentMonth = 12;
            $this->currentYear--;
        } else {
            $this->currentMonth--;
        }
        $this->cargarEventos();
    }

    // Método para avanzar al mes siguiente
    public function mesSiguiente()
    {
        if ($this->currentMonth == 12) {
            $this->currentMonth = 1;
            $this->currentYear++;
        } else {
            $this->currentMonth++;
        }
        $this->cargarEventos();
    }

    public function render()
    {
        $diaActual = now()->day; // Día actual del mes

        return view('livewire.admin.citas.inicio', [
            'diasDelMes' => Carbon::create($this->currentYear, $this->currentMonth)->daysInMonth,
            'primerDiaDelMes' => Carbon::create($this->currentYear, $this->currentMonth, 1)->dayOfWeek,
            'diaActual' => $diaActual, // Pasar día actual a la vista
            'eventos' => $this->eventos,
        ]);
    }
}
