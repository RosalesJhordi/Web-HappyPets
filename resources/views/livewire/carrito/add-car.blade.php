<div>
    <h1 class="text-gray-400 font-semibold text-xl">Agregar producto <strong>{{ $nombre }}</strong> a carrito</h1>
    <div class="flex justify-between items-center border mt-4 rounded-md">
        <button class="btn btn-primary" wire:click='decrementar'>
            <i class="fa-solid fa-minus"></i>
        </button>
        <div class="flex flex-col justify-center items-center">
            <span class="text-2xl font-bold">
                {{ $cantidad }}
            </span>
            <p class="text-gray-400">Cantidad</p>
        </div>
        <button class="btn btn-primary" wire:click='incrementar'>
            <i class="fa-solid fa-plus"></i>
        </button>
    </div>
    <p>Precio Unti: {{ $importe }}</p>
    <p>Total: {{ $total }}</p>
    <select class="select select-bordered w-full max-w-xs" wire:model.live='color'>
        <option disabled selected>Seleciona color:</option>
        <option>Rojo</option>
        <option>Azul</option>
        <option>Verde</option>
        <option>Amarillo</option>
    </select>
    <div>
        @if (Session::get('authToken'))
            <button class="btn btn-primary w-full" wire:click='agregarCarrito'>Agregar al carrito</button>
        @else
            <a href="Registro" class="btn btn-primary w-full" wire:click='agregarCarrito'>Agregar al carrito</a>
        @endif
    </div>
</div>
