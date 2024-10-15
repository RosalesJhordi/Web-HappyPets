<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Inicio extends Component
{
    public $permisos;
    public $notificacion;

    public $activeButton = 'home';

    public function setActive($button)
    {
        $this->activeButton = $button;
    }
    public function render()
    {
        return view('livewire.admin.inicio');
    }
}
