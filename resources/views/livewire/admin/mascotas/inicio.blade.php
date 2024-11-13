<div class="fw-full">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <div class="flex w-full gap-5">
        @livewire('admin.secciones.mascotas-count')
    </div>

    @if ($verHistorial)
        <div class="sticky z-50 max-w-4xl mx-auto bg-white top-16">
            <button class="btn btn-primary" wire:click='ocultarHistorial'>
                <i class="fa-solid fa-arrow-left"></i>
                volver
            </button>
        </div>

        <div class="max-w-4xl p-8 mx-auto mt-8 space-y-8 bg-gradient-to-r from-teal-100 via-blue-100 to-purple-100">
            <!-- Información de la Mascota -->
            @foreach ($historial['mascotas'] as $historia)
                <div class="p-6 mt-8 transition-transform transform bg-white rounded-lg shadow-lg hover:scale-105">
                    <h2 class="pb-4 text-2xl font-semibold text-purple-700 border-b border-purple-300">Datos de
                        Identificación del Paciente</h2>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div>
                            <label class="block font-medium text-purple-600">Nombre:</label>
                            <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                {{ $historia['nombre'] }}
                            </p>
                        </div>
                        <div>
                            <label class="block font-medium text-purple-600">Edad:</label>
                            <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                {{ $historia['edad'] }}
                            </p>
                        </div>
                        <div>
                            <label class="block font-medium text-purple-600">Especie:</label>
                            <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                {{ $historia['especie'] }}
                            </p>
                        </div>
                        <div>
                            <label class="block font-medium text-purple-600">Raza:</label>
                            <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                {{ $historia['raza'] }}
                            </p>
                        </div>
                        <div>
                            <label class="block font-medium text-purple-600">Sexo:</label>
                            <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                {{ $historia['sexo'] }}
                            </p>
                        </div>
                        <div>
                            <label class="block font-medium text-purple-600">Estado:</label>
                            <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                {{ $historia['estado'] }}
                            </p>
                        </div>
                        <div>
                            <label class="block font-medium text-purple-600">Propietario:</label>
                            <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                {{ $historia['usuario']['nombres'] . ' ' . $historia['usuario']['apellidos'] }}</p>
                        </div>
                        <div>
                            <label class="block font-medium text-purple-600">Teléfono:</label>
                            <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                {{ $historia['usuario']['telefono'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Historial Clínico de Citas -->
                @if (isset($historia['citas']) && !empty($historia['citas']))
                    @foreach ($historia['citas'] as $citas)
                        <div
                            class="p-6 mt-4 transition-transform transform bg-white border-l-4 border-purple-500 rounded-lg shadow-lg hover:scale-105">
                            <h2 class="pb-4 text-xl font-semibold text-teal-700 border-b border-teal-300">
                                {{ $citas['fecha'] . ' - ' . $citas['hora'] }}</h2>

                            <!-- Sección de cada cita -->
                            <div class="p-4 mt-4 space-y-4 rounded-lg shadow-md bg-teal-50">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-medium text-teal-600">Fecha:</label>
                                        <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                            {{ $citas['fecha'] }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block font-medium text-teal-600">Hora:</label>
                                        <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                            {{ $citas['hora'] }}
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block font-medium text-teal-600">Síntomas:</label>
                                        <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                            {{ $citas['sintomas'] }}</p>
                                    </div>
                                    <div>
                                        <label class="block font-medium text-teal-600">Estado:</label>
                                        <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">Estado de la
                                            Mascota
                                        </p>
                                    </div>
                                    <div>
                                        <label class="block font-medium text-teal-600">Tratamiento:</label>
                                        <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                            {{ $citas['tratamiento'] }}</p>
                                    </div>
                                    <div>
                                        <label class="block font-medium text-teal-600">Importe:</label>
                                        <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">S/.
                                            {{ $citas['importe'] }}</p>
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block font-medium text-teal-600">Observaciones:</label>
                                        <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                            {{ $citas['observaciones'] }}</p>
                                    </div>
                                    <div class="col-span-2">
                                        <label class="block font-medium text-teal-600">Próxima Cita:</label>
                                        <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                            {{ $citas['proxima_cita'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin de la sección de una cita -->
                        </div>
                    @endforeach
                @else
                    <div class="flex flex-col items-center justify-center w-full space-y-4">
                        <div class="avatar">
                            <div class="w-64 shadow-lg rounded-xl">
                                <img src="data:image/jpeg;base64,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"
                                    alt="Imagen de historial" />
                            </div>
                        </div>
                        <div class="space-y-2 text-center">
                            <h2 class="text-2xl font-semibold">Sin historial de Actividad</h2>
                            <p class="text-gray-600">No se encontraron detalles de actividad reciente</p>
                        </div>
                        <button wire:click='ocultarHistorial'
                            class="px-6 py-2 mt-4 text-white transition bg-blue-500 rounded-md shadow hover:bg-blue-600">
                            Ver otros historiales
                        </button>
                    </div>
                @endif
            @endforeach
        </div>
    @else
        {{-- filtro --}}
        <div class="relative flex items-center justify-between py-2 mt-3">
            <h1 class="py-2 font-extrabold text-gray-400 lg:text-xl text-md">Tabla Servicios</h1>
            {{-- buscador --}}
            <label class="flex items-center w-1/3 gap-2 p-1 input input-bordered">
                <input type="search" wire:model.live="buscado" id="default-search"
                    class="block w-full p-4 text-sm text-gray-900 border-none rounded-lg ps-10 bg-gray-50 focus:outline-none focus:ring-0 focus:border-transparent"
                    placeholder="Buscar por tipo" />
                <i class="px-2 text-xl text-gray-400 fa-solid fa-magnifying-glass"></i>
            </label>

            {{-- filtros --}}
            <div class="flex items-center justify-center gap-2">
                <details class="relative dropdown">
                    <summary class="m-1 cursor-pointer btn">
                        <i class="fa-solid fa-arrow-up-short-wide"></i>
                    </summary>

                    <!-- Contenido del dropdown -->
                    <div class="dropdown-content bg-gray-200 rounded-lg shadow-lg z-[1] right-0 absolute w-52 p-2">
                        <button type="button" class="w-full p-1 text-left rounded-md btn" wire:click="showAll">Mostrar
                            Todo</button>
                        <button type="button" class="w-full p-1 text-left rounded-md btn" wire:click="az">Ordenar
                            A-Z</button>
                        <button type="button" class="w-full p-1 text-left rounded-md btn" wire:click="za">Ordenar
                            Z-A</button>
                        <button type="button" class="w-full p-1 text-left rounded-md btn" wire:click='fechaup'>Más
                            Antiguos</button>
                        <button type="button" class="w-full p-1 text-left rounded-md btn" wire:click='fechadown'>Más
                            Recientes</button>
                    </div>
                </details>

                <button type="button" wire:click='obtenerdatos' class="btn btn-primary">
                    <i class="fa-solid fa-rotate-right"></i>
                </button>
            </div>

        </div>
        {{-- tabla --}}
        <div class="w-full overflow-x-auto">
            <table class="relative table h-full py-5 bg-white table-zebra" style="width: 100%">
                <!-- head -->
                <thead>
                    <tr class="border">
                        <th class="border">Imagen</th>
                        <th class="border">nombre</th>
                        <th class="border">edad</th>
                        <th class="border">especie</th>
                        <th class="border">raza</th>
                        <th class="border">sexo</th>
                        <th class="border">dueño</th>
                        <th class="border">Fecha Creacion</th>
                        <th class="border">Opciones</th>
                        <th class="border">Historial</th>
                    </tr>
                </thead>
                <tbody wire:loading.remove>
                    <!-- row 1 -->
                    @forelse ($datos as $dato)
                        {{-- {{ dd($dato['usuario']['nombres']) }} --}}
                        <tr wire:key="{{ $dato['id'] }}">
                            <td class="border">
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="w-20 h-12 mask mask-squircle">
                                            <img src="{{ 'https://api.happypetshco.com/ServidorMascotas/' . $dato['imagen'] }}"
                                                alt="Imagen servicio {{ $dato['nombre'] }}" class="w-full" />
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="border">
                                <span type="text" class="w-auto bg-transparent border-none focus:outline-none">
                                    {{ $dato['nombre'] }}
                                </span>
                            </td>
                            <td class="border">
                                <span type="text" class="w-auto bg-transparent border-none focus:outline-none">
                                    {{ $dato['edad'] }}
                                </span>
                            </td>
                            <td class="border">
                                <span type="text" class="w-auto bg-transparent border-none focus:outline-none">
                                    {{ $dato['especie'] }}
                                </span>
                            </td>
                            <td class="border">
                                <span type="text" class="w-auto bg-transparent border-none focus:outline-none">
                                    {{ $dato['raza'] }}
                                </span>
                            </td>
                            <td class="border">
                                <span type="text" class="w-auto bg-transparent border-none focus:outline-none">
                                    {{ $dato['sexo'] }}
                                </span>
                            </td>
                            <td class="border">
                                <span type="text" class="w-auto bg-transparent border-none focus:outline-none">
                                    {{ $dato['usuario']['nombres'] . ' ' . $dato['usuario']['apellidos'] }}
                                </span>
                            </td>
                            <td class="border">
                                {{ \Carbon\Carbon::parse($dato['created_at'])->locale('es')->diffForHumans() }}
                            </td>
                            <th class="border">
                                <div class="tooltip" data-tip="Ver">
                                    <button type="button" wire:click="verproducto({{ $dato['id'] }})"
                                        class="px-5 py-3 text-blue-500 bg-blue-200 border border-blue-500 badge"><i
                                            class="fa-regular fa-eye"></i></button>
                                </div>
                                <div class="tooltip" data-tip="Eliminar">
                                    <button wire:click='eliminar({{ $dato['id'] }})'
                                        class="px-5 py-3 text-red-500 bg-red-200 border border-red-500 badge"><i
                                            class="fa-solid fa-trash"></i></button>
                                </div>
                            </th>
                            <th class="border">
                                <div class="tooltip" data-tip="Ver">
                                    <button wire:key="verHistorial-{{ $dato['id'] }}" type="button"
                                        wire:click='ver({{ $dato['id'] }})'
                                        class="px-5 py-3 text-blue-500 bg-blue-200 border border-blue-500 badge">
                                        ver hsistorial
                                    </button>
                                </div>
                            </th>
                        </tr>
                        @empty
                        <tr>
                            <td class="border">
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="w-20 h-12 mask mask-squircle">
                                            <img src="data:image/jpeg;base64,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"
                                                alt="Imagen sin resultado" class="w-full" />
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td colspan="4 text-xl font-semibold">
                                <span
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 rounded-md bg-red-50 ring-1 ring-inset ring-red-600/10">
                                    No se encontraron mascotas.
                                </span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div wire:loading role="status"
                class="w-full p-4 space-y-4 border border-gray-200 divide-y divide-gray-200 rounded shadow animate-pulse dark:divide-gray-700 md:p-6 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-600 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-700"></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    @endif
</div>
<script>
    window.addEventListener('correcto', () => {
        document.getElementById('my_modal_3').close();
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
    });

    window.addEventListener('error', () => {
        document.getElementById('my_modal_3').close();
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
