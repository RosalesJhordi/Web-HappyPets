<?php

namespace App\Livewire\Admin\Usuarios;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Url;
use Livewire\Component;

class Empleados extends Component
{
    public $url;

    public $datos;

    public $datosusuario;

    public $ver = false;

    public $permisos = [];

    public $Administrador;

    public $Veterinario;

    public $Cajero;

    public $Usuario;

    public $id;

    #[Url(as: 'a')]
    public $routeName = 'clientes';

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->users();
    }

    public function users()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->withOptions([
            'verify' => false,
        ])->get($this->url.'/Usuarios');
        $respuesta = $response->json();

        $this->datos = collect($respuesta['usuarios'])->filter(function ($usuario) {
            $permisos = is_string($usuario['permisos'])
                ? explode(',', $usuario['permisos'])
                : $usuario['permisos'];

            return array_intersect($permisos, ['Cajero', 'Veterinario', 'Administrador']);
        })->values()->toArray();
    }

    public function verusuario($id)
    {
        $this->id = $id;
        $this->datosusuario = collect($this->datos)->firstWhere('id', $id);
        if ($this->datosusuario) {
            if (is_string($this->datosusuario['permisos'])) {
                $this->permisos = explode(',', $this->datosusuario['permisos']);

            } else {
                $this->permisos = $this->datosusuario['permisos'];
            }
        }
        $this->ver = ! $this->ver;
    }

    public function updatePermisos($permiso, $isChecked)
    {
        if ($isChecked) {
            if (! in_array($permiso, $this->permisos)) {
                $this->permisos[] = $permiso;
            }
        } else {
            if (($key = array_search($permiso, $this->permisos)) !== false) {
                unset($this->permisos[$key]);
            }
        }
    }

    public function actualizar()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->withOptions([
            'verify' => false,
        ])->put($this->url.'/ActualizarUsuario='.$this->id, [
            'nombres' => $this->datosusuario['nombres'],
            'telefono' => $this->datosusuario['telefono'],
            'ubicacion' => $this->datosusuario['ubicacion'],
            'permisos' => $this->permisos,
        ]);

        if ($response->successful()) {
            $respuesta = $response->json();
            session()->flash('correcto', 'Usuario actualizado correctamente');
        }else{
            session()->flash('error', 'Error al actualizar usuario');
        }
    }

    public function render()
    {
        return view('livewire.admin.usuarios.empleados');
    }
}
