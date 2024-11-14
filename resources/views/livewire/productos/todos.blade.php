<div class="w-full bg-white">
    <div class="max-w-2xl px-4 py-5 mx-auto sm:px-6 sm:py-10 lg:max-w-7xl lg:px-8">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">¡Mantente Informado sobre tu Clínica
            Veterinaria!</h5>
        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Descubre todas las novedades, servicios y
            cuidados para tus mascotas con nuestra aplicación. Recibe notificaciones importantes y mantén un seguimiento
            de las citas y tratamientos. ¡Descarga la app hoy mismo y cuida de tus peludos desde cualquier lugar!</p>

        <div class="flex items-center justify-center w-full">
            <div class="grid items-center justify-center w-full grid-cols-2 gap-2 xl:max-w-xl">

                <a href="#"
                    class="w-full h-16 sm:w-auto bg-green-600 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                    <svg class="me-3 w-7 h-7" aria-hidden="true" focusable="false" data-prefix="fab"
                        data-icon="google-play" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L104.6 499z">
                        </path>
                    </svg>
                    <div class="text-left rtl:text-right">
                        <div class="mb-1 text-xs">Disponible en</div>
                        <div class="-mt-1 font-sans text-sm font-semibold">Google Play</div>
                    </div>
                </a>

                <a href="#"
                    class="w-full h-16 sm:w-auto bg-blue-600 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                    <svg class="text-white me-3 w-7 h-7" aria-hidden="true" focusable="false" data-prefix="fab"
                        data-icon="google-play" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="#ffffff"
                            d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 242.7-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7 288 32zM64 352c-35.3 0-64 28.7-64 64l0 32c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-32c0-35.3-28.7-64-64-64l-101.5 0-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352 64 352zm368 56a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                    </svg>
                    <div class="text-left rtl:text-right">
                        <div class="mb-1 text-xs">Disponible en</div>
                        <div class="-mt-1 font-sans text-sm font-semibold">Descarga Directa</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="max-w-2xl px-4 py-5 mx-auto sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-xl font-bold tracking-tight text-gray-500 lg:text-2xl">Productos nuevos</h2>
        <div wire:loading.remove class="w-full">
            @if (!empty($datos))
                <div class="grid grid-cols-2 mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach ($datos as $data => $producto)
                        <div class="flex flex-col border rounded-md ">
                            <div class="relative cursor-pointer group" onclick="document.getElementById('my_modal_{{ $producto['id'] }}').showModal()">
                                <div
                                    class="w-full overflow-hidden bg-gray-200 rounded-md aspect-h-1 aspect-w-1 lg:aspect-none group-hover:opacity-75 lg:h-80">
                                    <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $producto['imagen'] }}"
                                        alt="Front of men&#039;s Basic Tee in black."
                                        class="object-cover object-center w-full h-80 lg:h-full lg:w-full">
                                    @if ($producto['descuento'])
                                        <div
                                            class="absolute top-0 left-0 z-20 flex items-center justify-center w-16 h-8 p-2 text-center text-white bg-red-500">
                                            -{{ $producto['descuento'] }}%
                                        </div>
                                    @endif
                                </div>
                                <div class="flex justify-between px-2 py-2 mt-4">
                                    <div>
                                        <h3 class="text-sm text-gray-700">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{ $producto['nm_producto'] }}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">{{ $producto['categorias']['nombre'] }}</p>
                                    </div>
                                    @if ($producto['descuento'])
                                        <div class="flex flex-col">
                                            <p class="text-sm font-semibold text-green-600">
                                                S/.
                                                {{ number_format($producto['precio'] - ($producto['precio'] * $producto['descuento']) / 100, 2) }}
                                            </p>
                                            <p class="text-sm font-semibold text-red-600 line-through ">S/.
                                                {{ $producto['precio'] }}</p>
                                        </div>
                                    @else
                                        <p class="text-sm font-semibold text-gray-900">S/. {{ $producto['precio'] }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="z-30 px-2 py-2">

                                <button onclick="document.getElementById('my_modal_{{ $producto['id'] }}').showModal()"
                                    class="w-full px-2 py-2 text-white cursor-pointer btn btn-primary">
                                    Agregar a carrito
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </button>

                                <dialog id="my_modal_{{ $producto['id'] }}" class="modal">
                                        @livewire('carrito.add-car', [$producto['nm_producto'], $producto['imagen'], $producto['id'], $producto['descuento'], $producto['precio'], $producto['descripcion'], $producto['colores'],$producto['stock']], key($producto['id']))
                                </dialog>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="w-full py-2">
                    <img src="{{ asset('img/undraw_taken_re_yn20.svg') }}" alt=""
                        class="object-fill w-full h-96">
                    <h1 class="py-3 text-xl text-center text-gray-600">NO SE ENCONTRARON PRODUCTOS DE ESTA CATEGORIA
                    </h1>
                </div>
            @endif
        </div>
        <div class="flex items-end justify-end w-full mt-4">
            <a href="{{ route('Productos') }}" class="flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white transition-transform duration-200 transform bg-blue-500 rounded-lg shadow-lg bg-gradient-to-r hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                  Ver más productos
                <span class="ml-2">
                    <i class="fa-solid fa-arrow-right"></i>
                </span>
            </a>
        </div>
        <div wire:loading class="flex items-center justify-center w-full">
            <div class="flex items-center justify-center w-full border border-gray-200 rounded-lg h-96 bg-gray-50 ">
                <div
                    class="px-5 py-3 text-2xl font-medium leading-none text-center text-white rounded-full bg-rosa animate-pulse ">
                    Cargando...</div>
            </div>
        </div>
    </div>
</div>
<script>
    // Escuchar el evento 'closeModal' emitido desde Livewire
    window.addEventListener('correcto', event => {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.close(); // Cerrar el modal
        }
    });
</script>
