<div class="max-w-2xl px-4 py-5 mx-auto sm:px-6 sm:py-10 lg:max-w-7xl lg:px-8">
    <h2 class="text-xl font-extrabold tracking-tight text-gray-800 lg:text-2xl">Nuevos Servicios</h2>
    <div class="grid grid-cols-2 gap-2 mt-8 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 lg:gap-8">
        @foreach ($datos as $dato)
            <div class="w-full p-4 transition-transform transform bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg hover:-translate-y-1">
                <div class="relative overflow-hidden rounded-md">
                    <img src="{{ 'https://api.happypetshco.com/ServidorServicios/' . $dato['imagen'] }}"
                         alt="{{ $dato['tipo'] }}" class="object-cover w-full transition-opacity duration-300 ease-in-out h-60 hover:opacity-90">
                </div>
                <div class="p-4">
                    <h5 class="mb-2 text-lg font-semibold text-gray-900 md:text-xl">{{ $dato['tipo'] }}</h5>
                    <p class="h-24 mb-4 text-sm text-gray-700 line-clamp-3">{{ $dato['descripcion'] }}</p>
                    <button type="button"
                    onclick="document.getElementById('my_modall_{{ $dato['id'] }}').showModal()"
                        class="flex items-center px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-md lg:text-base hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        Reservar cita
                        <svg class="w-4 h-4 ml-2 rtl:rotate-180" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10" aria-hidden="true">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </button>

                    <dialog id="my_modall_{{ $dato['id'] }}" class="modal">
                        @livewire('servicios.add-cita', [$dato['id']], key($dato['id']))
                </dialog>
                </div>
            </div>
        @endforeach
    </div>
    <div class="flex items-end justify-end w-full mt-4">
        <a href="{{ route('Servicios') }}" class="flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white transition-transform duration-200 transform bg-blue-500 rounded-lg shadow-lg bg-gradient-to-r hover:scale-105 focus:outline-none focus:ring-4 focus:ring-indigo-300">
              Ver más servicios
            <span class="ml-2">
                <i class="fa-solid fa-arrow-right"></i>
            </span>
        </a>
    </div>
</div>
