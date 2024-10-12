<span wire:poll='datosCarrito' class="indicator-item badge text-xs badge-primary">
    {{ is_countable($datos) ? count($datos) : 0 }}
</span>