<?php

namespace App\Livewire\Admin\Views;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Inicio extends Component
{
    public function mount(){

    }
    public function render()
    {
        return view('livewire.admin.views.inicio');
    }
}
