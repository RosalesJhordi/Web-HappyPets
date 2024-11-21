<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    @livewire('admin.secciones.usuarios-count')

    @if ($ver)
        <button wire:click="verusuario(0)" type="button" class="w-20 mt-4 text-xl btn btn-primary">
            <i class="fa-solid fa-arrow-left"></i>
        </button>


        <div class="flex items-center justify-center w-full">
            <div class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow ">
                <div class="flex flex-col items-center py-5 pb-10">
                    <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                        src="{{ asset('img/profile-user-icon-2048x2048-m41rxkoe.png') }}" alt="Bonnie image" />
                    <h5 class="mb-1 text-xl font-medium text-gray-900 ">{{ $datosusuario['nombres'] }}</h5>
                    <span class="text-sm text-gray-500 ">
                        <p>{{ implode(', ', $permisos) }}</p>
                    </span>

                    <h3 class="w-full px-2 mb-4 font-semibold text-gray-900 text-start">Permisos</h3>
                    <ul
                        class="items-center w-full px-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="vue-checkbox-list" type="checkbox" value="Administrador"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    wire:model.live="permisos"
                                    wire:change="updatePermisos('Administrador', $event.target.checked)"
                                    @if (is_array($permisos) && in_array('Administrador', $permisos)) checked @endif />
                                <label for="vue-checkbox-list"
                                    class="w-full py-3 text-sm font-medium text-gray-900 ms-2">Administrador</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="react-checkbox-list" type="checkbox" value="Veterinario"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    wire:model.live="permisos"
                                    wire:change="updatePermisos('Veterinario', $event.target.checked)"
                                    @if (is_array($permisos) && in_array('Veterinario', $permisos)) checked @endif />
                                <label for="react-checkbox-list"
                                    class="w-full py-3 text-sm font-medium text-gray-900 ms-2">Veterinario</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="angular-checkbox-list" type="checkbox" value="Cajero/Vendedor"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    wire:model.live="permisos"
                                    wire:change="updatePermisos('Cajero/Vendedor', $event.target.checked)"
                                    @if (is_array($permisos) && in_array('Cajero/Vendedor', $permisos)) checked @endif />
                                <label for="angular-checkbox-list"
                                    class="w-full py-3 mr-2 text-sm font-medium text-gray-900 ms-2">Cajero/Vendedor</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="angular-checkbox-list" type="checkbox" value="Almacenero"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    wire:model.live="permisos" wire:change="updatePermisos('Cajero', $event.target.checked)"
                                    @if (is_array($permisos) && in_array('Almacenero', $permisos)) checked @endif />
                                <label for="angular-checkbox-list"
                                    class="w-full py-3 text-sm font-medium text-gray-900 ms-2">Almacenero</label>
                            </div>
                        </li>
                        <li class="w-full">
                            <div class="flex items-center ps-3">
                                <input id="laravel-checkbox-list" type="checkbox" value="Cliente"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    wire:model.live="permisos" wire:change="updatePermisos('Usuario', $event.target.checked)"
                                    @if (is_array($permisos) && in_array('Usuario', $permisos)) checked @endif />
                                <label for="laravel-checkbox-list"
                                    class="w-full py-3 text-sm font-medium text-gray-900 ms-2">Cliente</label>
                            </div>
                        </li>
                    </ul>

                    @if (is_array($permisos) && in_array('Veterinario', $permisos))
                        <div class="max-w-md p-6 mx-auto mt-10 bg-white rounded-lg shadow-md">
                            <h2 class="mb-6 text-2xl font-semibold text-center text-gray-800">Formulario de Veterinario
                            </h2>
                            <!-- Especialidad -->
                            <div class="mb-4">
                                <label for="ubicacion"
                                    class="block text-sm font-medium text-gray-700">Especialidad</label>
                                <input type="text" id="especialidad" name="especialidad"
                                    wire:model.live='especialidad'
                                    class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                    placeholder="Ingrese una especialidad" required>
                            </div>
                        </div>
                    @endif


                    <div class="flex w-1/3 mt-4 md:mt-6">
                        <button wire:click="actualizar"
                            class="inline-flex items-center w-full px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                            Guardar cambios
                            </buttonv>

                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- filtro buscador --}}
        <div class="flex items-center justify-end w-full mt-2 border-none">
            <label class="flex items-center w-1/3 gap-2 p-1 input input-bordered">
                <input type="search" wire:model.live="buscado" id="default-search"
                    class="block w-full p-4 text-sm text-gray-900 border-none rounded-lg ps-10 bg-gray-50 focus:outline-none focus:ring-0 focus:border-transparent"
                    placeholder="Buscar por DNI..." />
                <i class="px-2 text-xl text-gray-400 fa-solid fa-magnifying-glass"></i>
            </label>
        </div>
        {{-- tabla --}}
        <div class="w-full overflow-x-auto">
            <table class="relative table h-full py-5 mt-4 bg-white table-zebra" style="width: 100%">
                <!-- head -->
                <thead>
                    <tr class="border">
                        <th class="border">Nombres</th>
                        <th class="border">Apellidos</th>
                        <th class="border">DNI</th>
                        <th class="border">Telefono</th>
                        <th class="border">Ubicacion</th>
                        <th class="border">Permisos</th>
                        <th class="border">Fecha Creacion</th>
                        <th class="border">Opciones</th>
                    </tr>
                </thead>
                <tbody wire:loading.remove>
                    <!-- row 1 -->
                    @forelse ($datos as $dato)
                        <tr wire:key="{{ $dato['id'] }}">

                            <td class="border">
                                <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['nombres'] }}" disabled />
                            </td>
                            <td class="border">
                                <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['apellidos'] }}" disabled />
                            </td>
                            <td class="border">
                                <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['dni'] }}" disabled />
                            </td>
                            <td class="border">
                                <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['telefono'] }}" disabled />
                            </td>
                            <td class="w-10 border ">
                                <input type="text" class="w-20 bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['ubicacion'] }}" disabled />
                            </td>
                            <td class="border ">
                                @foreach ($dato['permisos'] as $permiso)
                                    <input type="text" class="w-20 bg-transparent border-none focus:outline-none"
                                        value="{{ $permiso }}" disabled />
                                @endforeach
                            </td>
                            <td class="border">
                                {{ \Carbon\Carbon::parse($dato['created_at'])->locale('es')->diffForHumans() }}
                            </td>
                            <th class="border">
                                <div class="tooltip" data-tip="Editar">
                                    <button type="button" wire:click="verusuario({{ $dato['id'] }})"
                                        class="px-5 py-3 text-blue-500 bg-blue-200 border border-blue-500 badge">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>

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
                                    No se encontraron usuarios con este DNI.
                                </span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div wire:loading role="status"
                class="w-full p-4 space-y-4 border border-gray-200 divide-y divide-gray-200 rounded shadow animate-pulse md:p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full  w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full"></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full  w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full  w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full "></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full  w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full "></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full  w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full  w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full "></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full  w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full  w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full "></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full  w-12"></div>
                </div>
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    @endif
</div>
<script>
    window.addEventListener('correcto', () => {
        iziToast.success({
            message: 'Usuario actualizado correctamente',
            position: 'topRight',
            timeout: 5000,
            progressBar: true,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            theme: 'light',
            transitionIn: 'bounce'
        });
    });

    window.addEventListener('error', () => {
        iziToast.error({
            message: 'Error al actualizar usuario',
            position: 'topRight',
            timeout: 5000,
            progressBar: true,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            theme: 'light',
            transitionIn: 'bounce'
        });
    });
</script>
