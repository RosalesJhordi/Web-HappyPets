<div class="grid items-start w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8">
    <div class="overflow-hidden bg-gray-100 rounded-lg aspect-h-2 aspect-w-2 sm:col-span-4 lg:col-span-5">
        <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $imagen }}"
            alt="Two each of gray, white, and black shirts arranged on table." class="object-cover h-full">
    </div>
    <div class="sm:col-span-8 lg:col-span-7">
        <h2 class="text-2xl font-bold text-gray-900 sm:pr-12">{{ $nombre }}</h2>
        <p class="py-2 text-lg gray-500">
            {{ $descripcion }}
        </p>
        <section aria-labelledby="information-heading" class="mt-2">

            @if ($descuento)
                <div class="flex flex-col">
                    <p class="text-2xl font-bold text-red-600 line-through sm:pr-12 ">S/.
                        {{ $importe }}</p>
                    <p class="text-2xl font-bold text-green-600 sm:pr-12">
                        S/.
                        {{ number_format($importe - ($importe * $descuento) / 100, 2) }}
                    </p>
                </div>
            @else
                <p class="text-sm font-semibold text-gray-900">S/. {{ $importe }}</p>
            @endif
        </section>

        <section aria-labelledby="options-heading" class="mt-10">
            <!-- Colors -->
            <fieldset aria-label="Choose a color">
                @php
                    // Definir los colores y sus códigos hexadecimales
                    $allColors = [
                        'Rojo' => '#FF0000',
                        'Verde' => '#00FF00',
                        'Azul' => '#0000FF',
                        'Blanco' => '#FFFFFF',
                        'Morado' => '#800080',
                        'Amarillo' => '#FFFF00',
                        'Negro' => '#000000',
                    ];
                @endphp

                <label class="block w-full px-2 mt-2 mb-2 text-sm font-medium text-gray-900 text-start">
                    Selecciona color: {{ $color }}
                </label>

                <div class="grid items-center justify-start w-full grid-cols-4 gap-4 px-2 py-2 mb-4 md:grid-cols-7">
                    @foreach ($allColors as $colorName => $colorHex)
                        @if (in_array($colorName, $colores))
                            <label wire:click='actualizarcolor("{{ $colorName }}")'
                                class="relative -m-0.5 w-9 flex ring-transparent cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none @if ($color == $colorName) ring-4 ring-blue-500 @endif">
                                <input type="radio" name="color-choice" value="{{ $colorName }}"
                                    wire:model="selectedColor" class="sr-only">
                                <span class="w-8 h-8"
                                    style="background-color: {{ $colorHex }}; border: 1px solid {{ $colorHex }}; border-radius: 50%;"></span>
                            </label>
                        @endif
                    @endforeach
                </div>

            </fieldset>

            <legend class="py-2 mt-2 text-lg font-medium text-gray-900">Seleciona Cantidad</legend>
            <!-- cantidad -->
            <div class="flex items-center justify-between w-full py-3 space-x-4">
                <!-- Botón para decrementar -->
                <button wire:click='decrementar'
                    class="flex items-center justify-center w-10 h-10 text-white bg-red-600 rounded-full hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                    </svg>
                </button>
                <!-- Texto de la cantidad -->
                <h1 class="text-xl font-bold text-gray-900">{{ $cantidad }}</h1>

                <!-- Botón para incrementar -->
                <button wire:click='incrementar'
                    class="flex items-center justify-center w-10 h-10 text-white bg-blue-600 rounded-full hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </button>

            </div>

            <button wire:click='agregarCarrito' type="button"
                class="flex items-center justify-center w-full gap-3 px-8 py-3 mt-6 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Agregar
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </button>
        </section>
    </div>
</div>
