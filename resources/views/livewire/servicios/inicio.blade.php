<div class="max-w-2xl px-4 py-5 mx-auto sm:px-6 sm:py-10 lg:max-w-7xl lg:px-8">
    <h2 class="font-bold tracking-tight text-gray-500 lg:text-2xl text-md">Nuestros Servicios</h2>
    <div class="grid grid-cols-2 mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">

        @foreach ($datos as $dato)
            <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="relative w-full overflow-hidden rounded-md">
                    <style>
                        .imagen {
                            transition: opacity 2s ease;
                            opacity: 1;
                            cursor: pointer;
                        }
                    </style>
                    <img src="{{ 'https://api-happypetshco-com.preview-domain.com/ServidorServicios/' . $dato['imagen'] }}"
                        alt="Aseos" class="object-cover w-full h-60 md:h-96 imagen">
                </div>
                <div class="p-2 lg:p-5">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        {{ $dato['tipo'] }}
                    </h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        {{ $dato['descripcion'] }}
                    </p>
                    <button type="button"
                        class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-md lg:text-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Reservar cita
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>
</div>
