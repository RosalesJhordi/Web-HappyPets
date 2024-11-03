<div class="relative">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    @if ($ver)
        <button wire:click="verusuario(0)" type="button" class="w-20 mt-4 text-xl btn btn-primary">
            <i class="fa-solid fa-arrow-left"></i>
        </button>

        <div class="flex items-center justify-center w-full">
            <div class="w-full max-w-md bg-white border border-gray-200 rounded-lg shadow ">
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
                                    wire:model="permisos"
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
                                    wire:model="permisos"
                                    wire:change="updatePermisos('Veterinario', $event.target.checked)"
                                    @if (is_array($permisos) && in_array('Veterinario', $permisos)) checked @endif />
                                <label for="react-checkbox-list"
                                    class="w-full py-3 text-sm font-medium text-gray-900 ms-2">Veterinario</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r">
                            <div class="flex items-center ps-3">
                                <input id="angular-checkbox-list" type="checkbox" value="Cajero"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    wire:model="permisos" wire:change="updatePermisos('Cajero', $event.target.checked)"
                                    @if (is_array($permisos) && in_array('Cajero', $permisos)) checked @endif />
                                <label for="angular-checkbox-list"
                                    class="w-full py-3 text-sm font-medium text-gray-900 ms-2">Cajero</label>
                            </div>
                        </li>
                        <li class="w-full">
                            <div class="flex items-center ps-3">
                                <input id="laravel-checkbox-list" type="checkbox" value="Usuario"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                                    wire:model="permisos" wire:change="updatePermisos('Usuario', $event.target.checked)"
                                    @if (is_array($permisos) && in_array('Usuario', $permisos)) checked @endif />
                                <label for="laravel-checkbox-list"
                                    class="w-full py-3 text-sm font-medium text-gray-900 ms-2">Usuario</label>
                            </div>
                        </li>
                    </ul>

                    <div class="flex mt-4 md:mt-6">
                        <button wire:click="actualizar"
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                            Guardar cambios
                            </buttonv>


                    </div>
                </div>
            </div>
        </div>

        @if (session()->has('correcto'))
            <div class="absolute top-0 right-0 w-auto text-sm font-semibold text-white bg-green-500 rounded-md alert">
                <div
                    class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <span class="ml-2">{{ session('correcto') }}</span>

                <button class="ml-auto text-sm text-white hover:text-gray-200"
                    onclick="this.parentElement.style.display='none'">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif
    @else
        {{-- filtro buscador --}}
        <div class="flex items-center justify-end w-full mt-2 border-none">
            <div class="relative max-w-2xl bg-white">
                <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                    </svg>
                </div>
                <input type="text" id="simple-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                    placeholder="Search branch name..." required />
            </div>
        </div>
        {{-- tabla --}}
        <div class="w-full overflow-x-auto">
            <table class="relative table h-full py-5 mt-4 bg-white table-zebra" style="width: 100%">
                <!-- head -->
                <thead>
                    <tr class="border">
                        <th class="border">Nombres</th>
                        <th class="border">DNI</th>
                        <th class="border">Telefono</th>
                        <th class="border">Ubicacion</th>
                        <th class="border">Permisos</th>
                        <th class="border">Fecha Creacion</th>
                        <th class="border">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @foreach ($datos as $dato)
                        <tr wire:key="{{ $dato['id'] }}">

                            <td class="border">
                                <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['nombres'] }}" disabled />
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
                    @endforeach
                </tbody>
            </table>
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
