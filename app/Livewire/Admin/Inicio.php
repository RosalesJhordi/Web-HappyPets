<?php

namespace App\Livewire\Admin;

use Livewire\Attributes\Url;
use Livewire\Component;

class Inicio extends Component
{
    public $permisos;
    public $notificacion;

    public $activeButton;

    public function setActive($button)
    {
        $this->activeButton = $button;
    }
    public function mount(){
        $this->activeButton = 'home';
    }
    public function render()
    {
        return view('livewire.admin.inicio');
    }
}
