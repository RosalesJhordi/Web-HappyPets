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

    public function mount()
    {
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
        $this->obtenerCategorias();
    }

    public function obtenerCategorias(){
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
    public function addSubCategoria(){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->post($this->url.'/SubCategorias', [
            'nombre' => $this->nombreSubCategoria,
            'categorias_id' => $this->categorias_id
        ]);
        if ($response->successful()) {
            $this->reset(['nombreSubCategoria']);
            $this->dispatch('correcto', 'Sub Categoria registrada exitosamente');
            $this->obtenerCategorias();
        } else {
            $this->dispatch('error', 'Error al registrar la categoria');
        }
    }
    public function addSubSubCategoria(){
        $response = Http::withoutVerifying()->withToken(Session::get('authToken'))->post($this->url.'/SubSubCategorias', [
            'nombre' => $this->nombreSubSubCategoria,
            'sub_categorias_id' => $this->sub_categorias_id
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
