<div class="fw-full">
    <div class="flex w-full gap-5">
        @livewire('admin.secciones.mascotas-count')
    </div>


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
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @foreach ($datos as $dato)
                {{-- {{ dd($dato['usuario']['nombres']) }} --}}
                    <tr wire:key="{{ $dato['id'] }}">
                        <td class="border">
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-20 h-12 mask mask-squircle">
                                        <img src="{{ 'https://api-happypetshco-com.preview-domain.com/ServidorMascotas/' . $dato['imagen'] }}"
                                            alt="Imagen servicio {{ $dato['nombre'] }}" class="w-full" />
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="border">
                            <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                value="{{ $dato['nombre'] }}" disabled />
                        </td>
                        <td class="border">
                            <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                value="{{ $dato['edad'] }}" disabled />
                        </td>
                        <td class="border">
                            <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                value="{{ $dato['especie'] }}" disabled />
                        </td>
                        <td class="border">
                            <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                value="{{ $dato['raza'] }}" disabled />
                        </td>
                        <td class="border">
                            <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                value="{{ $dato['sexo'] }}" disabled />
                        </td>
                        <td class="border">
                            <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                value="{{ $dato['usuario']['nombres'] }}" disabled />
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

