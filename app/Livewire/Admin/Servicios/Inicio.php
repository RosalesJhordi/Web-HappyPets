<?php

namespace App\Livewire\Admin\Servicios;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;

class Inicio extends Component
{
    use WithFileUploads;

    public $url;

    public $datos;

    public $imagen;

    public $filtro = 'Todos';

    public $img = false;
    public $tipo;
    public $descripcion;
    public function mount()
    {
        $this->url = env('API_URL', 'https://api-happypetshco-com.preview-domain.com/api');
        $this->obtenerdatos();
    }

    public function obtenerdatos()
    {
        $response = Http::withoutVerifying()->get($this->url.'/ListarServicios');
        $respuesta = $response->json();
        $this->datos = $respuesta['servicios'];
    }

    public function addServicio()
    {
        if ($this->imagen) {
            $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->attach(
                'imagen',
                file_get_contents($this->imagen->getRealPath()),
                $this->imagen->getClientOriginalName()
            )->post($this->url.'/NuevoServicio', [
                'tipo' => $this->tipo,
                'descripcion' => $this->descripcion,
            ]);

            if ($response->successful()) {
                $this->reset(['tipo', 'descripcion', 'imagen']);
                $this->obtenerdatos();

                return back()->with('mensaje', 'Servicio registrado exitosamente');
            } else {
                return back()->with('error', 'Error: '.$response->body());
            }
        } else {
            return back()->with('error', 'Por favor, sube una imagen.');
        }
    }

    public function render()
    {
        return view('livewire.admin.servicios.inicio');
    }
}
