<?php

namespace App\Livewire\Admin\Usuarios;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Url;
use Livewire\Component;

class Clientes extends Component
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
    public $especialidad;
    public $buscado = '';
    public $filtro = 'Todos';

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

    public function users()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->withOptions([
            'verify' => false,
        ])->get($this->url.'/Usuarios');
        $respuesta = $response->json();
        // $this->datos = array_filter($respuesta['usuarios'], function ($usuario) {
        //     return $usuario['dni'] !== '71654843';
        // });

        $permisosExcluidos = ['Administrador', 'Veterinario', 'Cajero/Vendedor', 'Almacenero'];

        // Filtrar para excluir los usuarios con los permisos especificados
        $this->datos = array_filter($respuesta['usuarios'], function ($usuario) use ($permisosExcluidos) {
            // Verificar si el usuario tiene alguno de los permisos excluidos
            return !array_intersect($usuario['permisos'], $permisosExcluidos);
        });
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

        if($response->successful()){
            $this->dispatch('correcto');
        }else{
            $this->dispatch('error');
        }
    }

    public function render()
    {
        return view('livewire.admin.usuarios.clientes');
    }
}
