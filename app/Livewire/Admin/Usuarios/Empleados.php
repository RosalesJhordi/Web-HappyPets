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
    public $buscado = '';
    public $filtro = 'Todos';

    public $especialidad;

    #[Url(as: 'a')]
    public $routeName = 'clientes';

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->users();
    }
    public function buscarUsuario()
    {
        $usuarios = collect($this->datos);

        // Aplicar filtro si no es "Todos"
        if ($this->filtro !== 'Todos') {
            $usuarios = $this->aplicarFiltro($usuarios);
        }

        // Filtro de búsqueda por DNI
        if (! empty($this->buscado)) {
            $usuarios = $usuarios->filter(function ($usuario) {
                return str_contains(strtolower($usuario['dni']), strtolower($this->buscado));
            });
        } else {
            $this->users();
        }

        $this->datos = $usuarios->values()->all();
    }

    public function updatedbuscado()
    {
        if ($this->buscado == null){
            $this->users();
        }else{
            $this->buscarUsuario();
        }
    }

    private function aplicarFiltro($usuarios)
    {
        $filtros = [
            'A - Z' => function ($usuario) {
                return strtolower($usuario['nombres']);
            },
            'Z - A' => function ($usuario) {
                return strtolower($usuario['nombres']);
            },
            'ANTIGUOS' => function ($usuario) {
                return $usuario['created_at'];
            },
            'RECIENTES' => function ($usuario) {
                return $usuario['created_at'];
            },
        ];

        if (isset($filtros[$this->filtro])) {
            $usuarios = $usuarios->sortBy($filtros[$this->filtro]);

            if (in_array($this->filtro, ['Z - A', 'RECIENTES'])) {
                $usuarios = $usuarios->sortByDesc($filtros[$this->filtro]);
            }
        }

        return $usuarios;
    }

    public function showAll()
    {
        $this->filtro = 'Todos';
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

            return array_intersect($permisos, ['Cajero/Vendedor','Almacenero', 'Veterinario', 'Administrador']);
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
            'especialidad' => $this->especialidad ?? $this->datosusuario['especialidad'],
            'permisos' => $this->permisos,
        ]);

        if ($response->successful()) {
            $respuesta = $response->json();
            $this->dispatch('correcto');
            //session()->flash('correcto', 'Usuario actualizado correctamente');
        }else{
            $this->dispatch('error');
        }
    }

    public function render()
    {
        return view('livewire.admin.usuarios.empleados');
    }
}
