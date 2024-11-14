<?php

namespace App\Livewire\Perfil;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

class Perfil extends Component
{
    use WithFileUploads;

    public $url;

    public $nombres;

    public $dni;

    public $ubicacion;

    public $telefono;

    public $permisos = [];

    public $id;

    public $mascotas;

    public $imagen;

    public $img = false;

    public $historial = false;

    //mascota
    public $nombre;

    public $edad;

    public $especiee;

    public $raza;

    public $especies = [
        'Perro', 'Gato', 'Conejo', 'Hámster', 'Otro',
    ];

    public $especieSeleccionada = '';
    public $imagenUsuario;
    public $imagenUser;
    public $sexo;

    public $datosHistorial;
    public $especialidad;

    public $historialCollection;
    public $mascotaHistorial;
    public $descripcion;
    public $apellidos;
    #[Url(as: 'his')]
    public $his = 'historial';

    public function mostraHistorial($id)
    {
        $this->historial = true;
        $this->historialCollection = collect($this->datosHistorial['mascotas']);
        $mascotaHistorial = $this->historialCollection->firstWhere('id', $id);
        $this->mascotaHistorial = $mascotaHistorial;
    }
    public function ocultarHistorial(){
        $this->historial = false;
    }

    public function actualizarSexo($sex)
    {
        $this->sexo = $sex;
    }

    public function actualizarEspecie($especie)
    {
        $this->especieSeleccionada = $especie;
    }

    public function historialMascota()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url.'/HistorialMascota='.$this->id);

        if ($response->successful()) {
            $this->datosHistorial = $response->json();
        }
    }
    public function cargarDatosUsuario()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url.'/Datos');

        if ($response->successful()) {
            $data = $response->json();
            $this->id = $data['usuarios']['id'];
            $this->nombres = $data['usuarios']['nombres'];
            $this->permisos = $data['usuarios']['permisos'];
            $this->dni = $data['usuarios']['dni'];
            $this->especialidad = $data['usuarios']['especialidad'];
            $this->descripcion = $data['usuarios']['descripcion'];
            $this->ubicacion = $data['usuarios']['ubicacion'];
            $this->telefono = $data['usuarios']['telefono'];
            $this->apellidos = $data['usuarios']['apellidos'];
            $this->imagenUser = $data['usuarios']['imagen'];

            $dataaa = $this->permisos;
            if (is_string($dataaa)) {
                $permiso = explode(',', $dataaa);
            }
        }
    }

    public function ActualizarDatos(){
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ]);

        // Adjuntar la imagen solo si $imagenUsuario no está vacía
        if (!empty($this->imagenUsuario)) {
            $response = $response->attach(
                'imagen',
                file_get_contents($this->imagenUsuario->getRealPath()),
                $this->imagenUsuario->getClientOriginalName()
            );
        }

        $response = $response->post($this->url.'/EditEmpleado='.$this->id, [
            'nombres' => $this->nombres,
            'dni' => $this->dni,
            'descripcion' => $this->descripcion,
            'ubicacion' => $this->ubicacion,
            'telefono' => $this->telefono,
            'apellidos' => $this->apellidos,
            'especialidad' => $this->especialidad,
        ]);

        if ($response->successful()) {
            $this->cargarDatosUsuario();
            $this->dispatch('correcto', 'Datos Actualizados exitosamente');
        } else {
            $this->dispatch('error', 'Error al actualizar datos.');
        }
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
            'id_usuario' => $this->id,
        ]);
        if ($response->successful()) {
            $this->mascotas();
            $this->dispatch('correcto', 'Mascota Registrada exitosamente');
        }else{
            $this->dispatch('error', 'Error al registrar mascota.');
        }
    }

    public function mascotas()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.Session::get('authToken'),
        ])->withOptions([
            'verify' => false,
        ])->get($this->url.'/MascotasUsuario='.$this->id);

        if ($response->successful()) {
            $respuesta = $response->json();
            $this->mascotas = $respuesta['mascotas'];
        }
    }

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->cargarDatosUsuario();
        $this->mascotas();
        $this->historialMascota();
    }

    public function render()
    {
        return view('livewire.perfil.perfil');
    }
}
