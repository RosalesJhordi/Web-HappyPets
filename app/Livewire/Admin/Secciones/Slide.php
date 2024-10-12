<?php

namespace App\Livewire\Admin\Secciones;

use Livewire\Component;

class Slide extends Component
{
    public $currentSlide = 0;
    public $slides = [
        'slide1.webp',
        'slide2.webp',
        'slide3.webp',
        'slide4.webp',
    ];

    public function nextSlide()
    {
        $this->currentSlide = ($this->currentSlide + 1) % count($this->slides);
    }

    public function previousSlide()
    {
        $this->currentSlide = ($this->currentSlide - 1 + count($this->slides)) % count($this->slides);
    }
    public function render()
    {
        return view('livewire.admin.secciones.slide');
    }
}
