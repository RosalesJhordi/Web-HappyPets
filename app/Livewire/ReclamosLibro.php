<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ReclamosLibro extends Component
{
    public $url;
    public $nombres;
    public $telefono;
    public $reclamo;
    public function mount(){
        $this->url = env('API_URL', 'https://api.happypetshco.com/api');
    }
    public function Reclamar(){
        $response = Http::withoutVerifying()->post($this->url.'/NuevaReclamacion', [
            'nombres' => $this->nombres,
            'telefono' => $this->telefono,
            'reclamo' => $this->reclamo
        ]);
        if ($response->successful()) {
            $this->reset(['nombres', 'telefono', 'reclamo']);
            $this->obtenerdatos();

            $this->dispatch('correcto', 'Producto registrado con exito');
        } else {
            $this->dispatch('error', 'Error: '.$response->body());
        }
    }
    public function render()
    {
        return view('livewire.reclamos-libro');
    }
}
