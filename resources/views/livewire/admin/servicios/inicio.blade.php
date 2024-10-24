<div class="fw-full">
    <div class="flex w-full gap-5">
        @livewire('admin.secciones.servicios-count')
        <button onclick="my_modal_3.showModal()"
            class="flex items-center justify-start w-full h-32 gap-2 px-5 py-5 text-gray-400 bg-white border rounded-sm shadow-md md:w-1/5">
            <span class="flex items-center justify-center text-xl text-green-600 bg-green-200 rounded-full w-14 h-14">
                <i class="fa-solid fa-plus"></i>
            </span>
            <span>
                <h1 class="text-lg font-bold text-gray-400">Añadir Producto</h1>
            </span>
        </button>
    </div>

    {{-- modal --}}
    <dialog id="my_modal_3" class="modal" wire:ignore.self>
        <div class="w-11/12 max-w-6xl modal-box">
            <form method="dialog">
                <button class="absolute btn btn-xl btn-circle btn-ghost right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold">Agregar nuevo Servicio</h3>

            <form class="flex flex-col items-center justify-center gap-2 px-5 py-5"
                wire:submit="addServicio" novalidate>

                @if (session('mensaje'))
                    <div
                        class="flex items-center justify-center w-full gap-2 p-1 text-center text-green-600 bg-green-100 border border-green-600 rounded-sm">
                        <i class="fa-solid fa-check"></i>
                        <span>{{ session('mensaje') }}.</span>
                    </div>
                @endif

                @if (session('error'))
                    <div
                        class="flex items-center justify-center w-full gap-2 p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">
                        <i class="fa-solid fa-xmark"></i>
                        <span>{{ session('error') }}.</span>
                    </div>
                @endif

                <div class="grid w-full grid-cols-1 gap-6 xl:grid-cols-2">

                    <div class="flex items-center justify-center w-full h-full">
                        <label for="dropzone-file"
                            class="flex flex-col h-96 {{ $imagen ? 'border-green-600  bg-green-200' : 'border-gray-300 bg-slate-100' }} items-center justify-center w-full h-64 border-2  border-dashed rounded-lg cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-4 {{ $imagen ? 'text-green-600' : 'text-gray-500' }}"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-lg {{ $img ? 'text-green-600' : 'text-gray-500' }}""><span
                                        class="font-semibold">Seleciona </span> o arrastra y suelta imagen</p>
                                <p class="text-lg {{ $img ? 'text-green-600' : 'text-gray-500' }}"">SVG, PNG, JPG o
                                    GIF</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" wire:model.live="imagen" />
                        </label>
                    </div>

                    <div class="flex flex-col items-center justify-center w-full h-full gap-2">

                        {{-- tipo servicio --}}

                        <div class="relative w-full">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                            <input wire:model.live="tipo" type="text" id="input-group-1"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                placeholder="Tipo de servicio">
                        </div>

                        {{-- descripcion producto --}}

                        <textarea id="message" rows="4" wire:model.live="descripcion"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                            placeholder="Descripcion corta del producto"></textarea>

                        <button type="submit"
                            class="w-full p-2 mt-5 text-white bg-purple-700 rounded-md hover:bg-purple-600">Agregar
                            Servicio</button>
                    </div>

                </div>
            </form>
        </div>
    </dialog>



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
                    <th class="border">Tipo</th>
                    <th class="border">Descripcion</th>
                    <th class="border">Fecha Creacion</th>
                    <th class="border">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @foreach ($datos as $dato)
                    <tr wire:key="{{ $dato['id'] }}">
                        <td class="border">
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-20 h-12 mask mask-squircle">
                                        <img src="{{ 'https://api-happypetshco-com.preview-domain.com/ServidorServicios/' . $dato['imagen'] }}"
                                            alt="Imagen servicio {{ $dato['tipo'] }}" class="w-full" />
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="border">
                            <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                value="{{ $dato['tipo'] }}" disabled />
                        </td>
                        <td class="border">
                            <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                value="{{ $dato['descripcion'] }}" disabled />
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
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
