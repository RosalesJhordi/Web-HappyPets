<?php

namespace App\Livewire\Servicios;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddCita extends Component
{
    use WithFileUploads;
    public $url;
    public $id_servicio;
    public $step = 0;
    public $id_user;
    public $mascotas;
    public $especies = [
        'Perro', 'Gato', 'Conejo', 'Hámster', 'Otro',
    ];
    public $especieSeleccionada = '';
    public $imagen;
    public $img;
    public $id_mascota;
    public $nombre;
    public $edad;
    public $raza;
    public $sexo;
    public $currentMonth;
    public $currentYear;
    public $currentWeek;
    public $weekStart;
    public $weekEnd;
    public $daysInWeek;
    public $dia;
    public $hora;
    public $availableHours;
    public $mascota;

    public function mount($id){
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->id_servicio = $id;
        $this->currentMonth = Carbon::now()->month;
        $this->currentYear = Carbon::now()->year;

        $this->currentWeek = Carbon::now()->weekOfYear;
        $this->calculateWeekDays();
        $this->generateAvailableHours();

        if(Session::get('authToken')){

            $this->cargarDatosUsuario();
            $this->obtenerMascotas();
        }
    }
    public $metodoSeleccionado;

    public function seleccionarMetodo($metodo)
    {
        $this->metodoSeleccionado = $metodo;
    }

    public function reservarCita(){
        // Reservar la cita
        $datosCita = [
            'fecha' => Carbon::parse($this->dia)->format('d/m/Y'),
            'hora' => $this->hora,
            'id_servicio' => $this->id_servicio,
            'id_mascota' => $this->id_mascota,
            'estado' => "Pendiente",
            'tipo_pago' => $this->metodoSeleccionado,
        ];

        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->post($this->url. '/NuevaCita', $datosCita);
        $respuesta = $response->json();

        if($response->successful()){
            $this->dispatch('modal', $this->id_servicio);
            $this->dispatch('correcto', 'Cita reservada correctamente');
        } else {
            $this->dispatch('modal', $this->id_servicio);
            $this->dispatch('error', 'Ocurrio un error reservar cita');
        }
    }
    public function datosMascota(){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->
        get($this->url . '/Mascota='.$this->id_mascota);
        $respuesta = $response->json()['mascota'];
        $this->mascota = $respuesta;
    }
    public function calculateWeekDays()
    {
        // Calcular el inicio y fin de la semana actual
        $this->weekStart = Carbon::now()->setISODate($this->currentYear, $this->currentWeek)->startOfWeek();
        $this->weekEnd = Carbon::now()->setISODate($this->currentYear, $this->currentWeek)->endOfWeek();

        // Obtenemos los días de la semana actual
        $this->daysInWeek = collect();
        for ($i = 0; $i < 7; $i++) {
            $this->daysInWeek->push($this->weekStart->copy()->addDays($i));
        }
    }
    public function selectDay($day)
    {
        $this->dia = $day;
        $this->generateAvailableHours();
        // $this->citasReservadas();
    }
    public function selectHour($hour)
    {
        $this->hora = $hour;
    }
    public function generateAvailableHours()
    {
        $selectedDate = Carbon::parse($this->dia);

        if ($selectedDate->isMonday()) {
            $this->availableHours = [];
            return;
        }

        $this->availableHours = [];
        for ($hour = 8; $hour <= 20; $hour++) {
            $this->availableHours[] = $selectedDate->copy()->setTime($hour, 0)->format('h:i A');
        }
    }
    public function goToNextWeek()
    {
        $this->currentWeek++;
        if ($this->currentWeek > Carbon::now()->weeksInYear) {
            $this->currentWeek = 1;
            $this->currentYear++;
        }
        $this->calculateWeekDays();
    }

    public function goToPreviousWeek()
    {
        $this->currentWeek--;
        if ($this->currentWeek < 1) {
            $this->currentWeek = Carbon::now()->weeksInYear;
            $this->currentYear--;
        }
        $this->calculateWeekDays();
    }
    public function actualizarSexo($sex)
    {
        $this->sexo = $sex;
    }
    public function addMascota()
    {
        if ($this->especieSeleccionada == null or $this->especieSeleccionada == '' or $this->especieSeleccionada == 'Otro') {
            $espe = $this->especiee;
        } else {
            $espe = $this->especieSeleccionada;
        }
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->attach(
            'imagen',
            file_get_contents($this->imagen->getRealPath()),
            $this->imagen->getClientOriginalName()
        )->post($this->url.'/NuevaMascota', [
            'nombre' => $this->nombre,
            'edad' => $this->edad,
            'especie' => $espe,
            'raza' => $this->raza,
            'sexo' => $this->sexo,
            'id_usuario' => $this->id_user,
        ]);
        if ($response->successful()) {
            $this->obtenerMascotas();
            $this->dispatch('correcto', 'Mascota Registrada exitosamente');
        }else{
            $this->dispatch('error', 'Error al registrar mascota.');
        }
    }

    public function actualizarEspecie($especie)
    {
        $this->especieSeleccionada = $especie;
    }
    public function actualizarMascota($id_mascota){
        $this->id_mascota = $id_mascota;
        $this->datosMascota();
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
