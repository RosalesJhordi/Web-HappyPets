<div class="w-full bg-white">
    <div
    class="max-w-2xl px-4 py-5 mx-auto sm:px-6 sm:py-10 lg:max-w-7xl lg:px-8">
        <h5 class="mb-2 text-3xl font-bold text-gray-900 dark:text-white">¡Mantente Informado sobre tu Clínica
            Veterinaria!</h5>
        <p class="mb-5 text-base text-gray-500 sm:text-lg dark:text-gray-400">Descubre todas las novedades, servicios y
            cuidados para tus mascotas con nuestra aplicación. Recibe notificaciones importantes y mantén un seguimiento
            de las citas y tratamientos. ¡Descarga la app hoy mismo y cuida de tus peludos desde cualquier lugar!</p>

        <div class="items-center justify-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4 rtl:space-x-reverse">
            <a href="#"
                class="w-full sm:w-auto bg-gray-800 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <svg class="me-3 w-7 h-7" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="apple"
                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                    <path fill="currentColor"
                        d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z">
                    </path>
                </svg>
                <div class="text-left rtl:text-right">
                    <div class="mb-1 text-xs">Disponible en </div>
                    <div class="-mt-1 font-sans text-sm font-semibold">App Store</div>
                </div>
            </a>
            <a href="#"
                class="w-full sm:w-auto bg-green-800 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-gray-300 text-white rounded-lg inline-flex items-center justify-center px-4 py-2.5 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                <svg class="me-3 w-7 h-7" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google-play"
                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor"
                        d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L104.6 499z">
                    </path>
                </svg>
                <div class="text-left rtl:text-right">
                    <div class="mb-1 text-xs">Disponible en</div>
                    <div class="-mt-1 font-sans text-sm font-semibold">Google Play</div>
                </div>
            </a>
        </div>
    </div>
    <div class="max-w-2xl px-4 py-5 mx-auto sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-xl font-bold tracking-tight text-gray-500 lg:text-2xl">Productos nuevos</h2>
        @if (!empty($datos))
            <div wire:poll='obtenerdatos'
                class="grid grid-cols-2 mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($datos as $data)
                    <div class="relative border rounded-md group">
                        <style>
                            .imagen {
                                transition: transform 0.5s ease; /* Animación suave */
                            }

                            .imagen:hover {
                                transform: scaleX(-1); /* Refleja horizontalmente la imagen */
                            }
                        </style>
                        <div
                            class="w-full overflow-hidden bg-gray-200 rounded-md aspect-h-1 aspect-w-1 lg:aspect-none group-hover:opacity-75 lg:h-80 imagen">
                            <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $data['imagen'] }}"
                                alt="Front of men&#039;s Basic Tee in black."
                                class="object-cover object-center w-full h-full lg:h-full lg:w-full">
                        </div>
                        <div class="flex justify-between px-2 py-2 mt-4">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $data['nm_producto'] }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ $data['categorias_id'] }}</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">S/. {{ $data['precio'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center justify-end w-full py-2 mt-2">
                <a href="{{ route('Productos') }}"
                class="flex items-center justify-between p-1 px-2 font-semibold lg:p-2 lg:px-5 text-md lg:text-xl btn btn-primary">
                    Ver mas productos
                </a>
            </div>
        @else
            <div>
                <h1>Productos no encontrados</h1>
            </div>
        @endif
    </div>
</div>
