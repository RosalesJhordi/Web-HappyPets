<div class="w-full bg-white">
    <div class="max-w-2xl px-4 py-5 mx-auto sm:px-6 sm:py-10 lg:max-w-7xl lg:px-8">
        <h2 class="text-xl font-bold tracking-tight text-gray-500 lg:text-2xl">Productos en descuento</h2>
        @if (!empty($datos))
            <div wire:poll='obtenerdatos'
                class="grid grid-cols-2 mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($datos as $data)
                    <div class="relative border rounded-md group">
                        <div
                            class="relative w-full overflow-hidden bg-gray-200 rounded-md aspect-h-1 aspect-w-1 lg:aspect-none group-hover:opacity-75 lg:h-80">
                            <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $data['imagen'] }}"
                                alt="Front of men&#039;s Basic Tee in black."
                                class="object-cover object-center w-full h-full lg:h-full lg:w-full">
                            <div class="absolute top-0 left-0 z-20 flex items-center justify-center w-16 h-8 p-2 text-center text-white bg-red-500" >
                                -{{ $data['descuento'] }}%
                            </div>
                        </div>
                        <div class="flex justify-between px-2 py-2 mt-4">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $data['nm_producto'] }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ $data['categoria'] }}</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">S/. {{ $data['precio'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center justify-end w-full py-2 mt-2">
                <a href="{{ route('Productos') }}" class="flex items-center justify-between p-1 px-2 font-semibold lg:p-2 lg:px-5 text-md lg:text-xl btn btn-primary">
                    Ver mas productos
                </a>
            </div>
        @else
            <div>
                <h1>Productos no encontrados</h1>
            </div>
        @endif
        <h2 class="py-5 mt-5 text-xl font-bold tracking-tight text-gray-500 lg:text-2xl">Nuestras Categorias</h2>
        <div class="grid flex-wrap grid-cols-5 gap-2 py-2 mb-5">
            @foreach ($categorias as $categoria)
                <a href="#" class="flex flex-col items-center justify-center w-full text-white btn bg-rosa">
                    @if ($categoria == "Alimentos y Golosinas")
                        <i class="fa-solid fa-mortar-pestle"></i>
                    @endif
                    {{ $categoria }}
                </a>
            @endforeach
        </div>

        <section
            class="bg-center bg-no-repeat bg-[url('https://assets-au-01.kc-usercontent.com/ab37095e-a9cb-025f-8a0d-c6d89400e446/5dbf581b-8254-4aa2-b523-aa91735b9075/article-curious-things-my-pet-does.jpg')] bg-gray-700 bg-blend-multiply">
            <div class="max-w-screen-xl px-4 py-5 mx-auto text-center lg:py-56">
                <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-white md:text-5xl lg:text-6xl">
                    Cuidamos a tu mascota con amor y dedicación.</h1>
                <p class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">En nuestra clínica
                    veterinaria nos enfocamos en áreas donde el cuidado especializado, la innovación en salud animal y
                    la atención personalizada pueden generar bienestar a largo plazo para sus mascotas.</p>
                <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                        Reservar cita
                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                    <a href="#"
                        class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-white border border-white rounded-lg hover:text-gray-900 sm:ms-4 hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                        Ver productos
                    </a>
                </div>
            </div>
        </section>


    </div>
</div>
