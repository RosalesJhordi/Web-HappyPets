<?php

namespace App\Livewire\Admin\Categorias;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Inicio extends Component
{
    public $url;

    public $nombreCategoria;

    public $categorias;

    public $categorias_id;

    public $nombreSubCategoria;

    public $nombreSubSubCategoria;

    public $sub_categorias_id;

    public $subcategorias;

    public $categoriaTree;
    public $editarCategoria = false;
    public $editarSubCategoria = false;
    public $editarSubSubCategoria = false;

    public $editarCategoria_id;
    public $editarSubCategoria_id;
    public $editarSubSubCategoria_id;

    public $NuevaCategoria;
    public $NuevaSubCategoria;
    public $NuevaSubSubCategoria;

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->obtenerCategorias();
    }
    public function editCategoria($id)
    {
        $this->editarCategoria = true;
        $this->editarSubSubCategoria = false;
        $this->editarSubCategoria = false;
        $this->editarCategoria_id = $id;
    }
    public function guardarCategoria(){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->post($this->url.'/ActualizarCategoria='.$this->editarCategoria_id, [
            'nombre' => $this->NuevaCategoria,
        ]);
        if ($response->successful()) {
            $this->reset(['NuevaCategoria']);

            $this->dispatch('correcto', 'Categoria actualizada exitosamente');
            $this->obtenerCategorias();
        } else {
            $this->dispatch('error', 'Error al actualizar la categoria');
        }
    }
    public function eliminarCategoria($id)
    {
        dd($id);
        // $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->delete($this->url.'/Categorias/'.$id);
        // if ($response->successful()) {
        //     $this->dispatch('correcto', 'Categoria eliminada exitosamente');
        //     $this->obtenerCategorias();
        // } else {
        //     $this->dispatch('error', 'Error al eliminar la categoria');
        // }
    }

    public function editSubCategoria($id)
    {
        $this->editarSubCategoria = true;
        $this->editarCategoria = false;
        $this->editarSubSubCategoria = false;
        $this->editarSubCategoria_id = $id;
    }
    public function guardarSubCategoria(){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->post($this->url.'/ActualizarSubCategoria='.$this->editarSubCategoria_id, [
            'nombre' => $this->NuevaSubCategoria,
        ]);
        if ($response->successful()) {
            $this->reset(['NuevaSubCategoria']);

            $this->dispatch('correcto', 'Sub-Categoria actualizada exitosamente');
            $this->obtenerCategorias();
        } else {
            $this->dispatch('error', 'Error al actualizar la sub-categoria');
        }
    }

    public function eliminarSubCategoria($id)
    {
        dd($id);
    }

    public function editSubSubCategoria($id)
    {
        $this->editarSubSubCategoria = true;
        $this->editarSubCategoria = false;
        $this->editarCategoria = false;
        $this->editarSubSubCategoria_id = $id;
    }
    public function guardarSubSubCategoria(){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->post($this->url.'/ActualizarSubSubCategoria='.$this->editarSubSubCategoria_id, [
            'nombre' => $this->NuevaSubSubCategoria,
        ]);
        if ($response->successful()) {
            $this->reset(['NuevaSubSubCategoria']);
            $this->dispatch('correcto', 'Sub-Sub-Categoria actualizada exitosamente');
            $this->obtenerCategorias();
        } else {
            $this->dispatch('error', 'Error al actualizar la sub-sub-categoria');
        }
    }

    public function eliminarSubSubCategoria($id)
    {
        dd($id);
    }

    public function obtenerCategorias()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarCategorias');
        $this->categorias = $response->json()['categorias'] ?? [];
        $respons = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/ListarSubCategorias');
        $this->subcategorias = $respons->json()['subcategorias'] ?? [];
        $respons = Http::withoutVerifying()->withToken(Session::get('authToken'))->get($this->url.'/CategoriasArbol');
        $this->categoriaTree = $respons->json()['categorias'] ?? [];
        //dd($this->categoriaTree);
    }

    public function addCategoria()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->post($this->url.'/Categorias', [
            'nombre' => $this->nombreCategoria,
        ]);
        if ($response->successful()) {
            $this->reset(['nombreCategoria']);

            $this->dispatch('correcto', 'Categoria registrada exitosamente');
            $this->obtenerCategorias();
        } else {
            $this->dispatch('error', 'Error al registrar la categoria');
        }
    }

    public function addSubCategoria()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->post($this->url.'/SubCategorias', [
            'nombre' => $this->nombreSubCategoria,
            'categorias_id' => $this->categorias_id,
        ]);
        if ($response->successful()) {
            $this->reset(['nombreSubCategoria']);
            $this->dispatch('correcto', 'Sub Categoria registrada exitosamente');
            $this->obtenerCategorias();
        } else {
            $this->dispatch('error', 'Error al registrar la categoria');
        }
    }

    public function addSubSubCategoria()
    {
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->post($this->url.'/SubSubCategorias', [
            'nombre' => $this->nombreSubSubCategoria,
            'sub_categorias_id' => $this->sub_categorias_id,
        ]);
        if ($response->successful()) {
            $this->reset(['nombreSubSubCategoria']);

            $this->dispatch('correcto', 'Sub-Sub Categoria registrada exitosamente');
            $this->obtenerCategorias();
        } else {
            $this->dispatch('error', 'Error al registrar la categoria');
        }
    }

    public function render()
    {
        return view('livewire.admin.categorias.inicio');
    }
}
