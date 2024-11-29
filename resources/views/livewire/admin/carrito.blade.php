<div class="w-11/12 max-w-5xl modal-box">
    <form method="dialog">

        <button id="closeButton"
            class="absolute top-0 right-0 z-50 bg-gray-100 border-none btn btn-md focus:outline-none focus:ring-0 btn-ghost">
            ✕</button>
    </form>

    <div class="grid items-start w-full grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-12 lg:gap-x-8">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
        <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
        <div class="h-full overflow-hidden bg-gray-100 rounded-lg aspect-h-2 aspect-w-2 sm:col-span-4 lg:col-span-5">
            <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $imagen }}"
                alt="Two each of gray, white, and black shirts arranged on table." class="object-cover h-full">
        </div>
        <div class="sm:col-span-8 lg:col-span-7">
            <h2 class="text-2xl font-bold text-gray-900 sm:pr-12">{{ $nombre }}</h2>
            <p class="py-3 text-lg font-medium leading-relaxed text-gray-700">
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
                    <p class="text-2xl font-bold text-green-600 sm:pr-12">
                        S/. {{ $importe }}
                    </p>
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
                                    class="relative -m-0.5 w-9 flex border ring-transparent cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none @if ($color == $colorName) ring-4 ring-blue-500 @endif">
                                    <input type="radio" name="color-choice" value="{{ $colorName }}"
                                        wire:model.live="selectedColor" class="sr-only">
                                    <span class="w-8 h-8"
                                        style="background-color: {{ $colorHex }}; border: 1px solid {{ $colorHex }}; border-radius: 50%;"></span>
                                </label>
                            @endif
                        @endforeach
                    </div>

                </fieldset>

                <legend class="py-2 mt-2 text-lg font-medium text-gray-900">Seleciona Cantidad</legend>
                <!-- cantidad -->
                <div class="flex items-center justify-between w-full p-4 py-4 space-x-6 rounded-lg bg-gray-50">
                    <!-- Botón para decrementar -->
                    <button wire:click='decrementar'
                        class="flex items-center justify-center w-12 h-12 text-white transition-all transform bg-red-600 rounded-full hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                        </svg>
                    </button>

                    <!-- Texto de la cantidad con Badge -->
                    <div class="flex items-center space-x-2">
                        <h1 class="text-2xl font-semibold tracking-tight text-gray-800">{{ $cantidad }}</h1>
                        @if ($noDisponible)
                            <span
                                class="px-2 py-1 text-xs font-medium text-white bg-red-500 rounded-full">{{ $noDisponible }}</span>
                        @endif
                    </div>

                    <!-- Botón para incrementar -->
                    <button wire:click='incrementar'
                        class="flex items-center justify-center w-12 h-12 text-white transition-all transform bg-green-600 rounded-full hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                </div>
                <p class="text-xl font-semibold text-gray-800">
                    <span class="text-lg text-gray-500">SubTotal: S/. </span>
                    <span class="text-xl font-bold text-gray-600">{{ $total ?? 0 }}</span>
                </p>

                <div wire:loading.remove class="w-full">
                    @if (Session::get('authToken'))
                        <button wire:click='agregarCarrito' type="button" {{ $cantidad <= 0 ? 'disabled' : '' }}
                            class="flex {{ $cantidad <= 0 ? 'cursor-not-allowed hover:bg-indigo-300 bg-indigo-200' : 'cursor-pointer hover:bg-indigo-700 bg-indigo-600' }} items-center justify-center w-full gap-3 px-8 py-3 mt-6 text-base font-medium text-white  border border-transparent rounded-md  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Agregar
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </button>
                    @else
                        <a href="{{ route('Registro') }}" {{ $cantidad <= 0 ? 'disabled' : '' }}
                            class="flex {{ $cantidad <= 0 ? 'cursor-not-allowed hover:bg-indigo-300 bg-indigo-200' : 'cursor-pointer hover:bg-indigo-700 bg-indigo-600' }} items-center justify-center w-full gap-3 px-8 py-3 mt-6 text-base font-medium text-white  border border-transparent rounded-md  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Agregar
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                            </svg>
                        </a>
                    @endif
                </div>
                <div wire:loading class="w-full h-full">
                    <button type="button"
                        class="flex items-center justify-center w-full gap-3 px-8 py-3 mt-6 text-base font-medium text-white bg-indigo-500 border border-transparent rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        disabled>
                        Agregando<span class="loading loading-dots loading-sm"></span>
                    </button>
                </div>


            </section>
        </div>
    </div>
</div>
<script>
    let toastShown = false;

    window.addEventListener('correct', (event) => {
        if (toastShown) return;

        iziToast.success({
            message: event.detail,
            position: 'topRight',
            timeout: 5000,
            progressBar: true,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            theme: 'light',
            transitionIn: 'bounce',
            zindex: 999999
        });

        setTimeout(() => {
            toastShown = false;
        }, 5000);
    });

    window.addEventListener('modal', event => {
        const modalId = event.detail;
        const modal = document.getElementById("my_modal_" + modalId);

        if (modal) {
            console.log("cerrado");
            modal.close();
        } else {
            console.log(modal);
        }
    });



    window.addEventListener('erro', (event) => {
        const closeButton = document.getElementById('closeButton');
        const dialog = document.getElementById('my_modal_{{ $id }}');

        closeButton.click();
        iziToast.error({
            message: event.detail,
            position: 'topRight',
            timeout: 5000,
            progressBar: true,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            theme: 'light',
            transitionIn: 'bounce',
            zindex: 999999
        });
    });
</script>
