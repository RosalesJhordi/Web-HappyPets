<div class="w-auto drawer drawer-end">
    <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
        <!-- Page content here -->
        <label for="my-drawer-4" class="cursor-pointer drawer-button">
            <div id="openDrawer" class="flex items-center justify-center text-gray-400 rounded-full indicator hover:white">
                <div class="flex items-center mr-3">
                    <div class="text-2xl indicator">
                        <span class="text-xs indicator-item badge badge-primary">
                            @if ($datosCarrito)
                                {{ count($datosCarrito) }}
                            @else
                                0
                            @endif
                        </span>
                        <i class="fa-regular fa-bell"></i>
                    </div>
                </div>
            </div>
        </label>
    </div>
    <div class="drawer-side" style="z-index: 9999;">
        <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="min-h-full p-4 bg-white w-80 md:w-96 menu text-base-content" style="z-index: 9999;">

            <div class="container mx-auto">
                <h1 class="mb-8 text-3xl font-bold text-center text-gray-900">Notificaciones</h1>
                @if (Session::has('authToken'))
                <div class="tabs">
                    <div class="block">
                        <ul
                            class="grid items-center justify-center min-w-full grid-cols-3 gap-2 transition-all duration-300 border-b border-gray-200">
                            @if (in_array('Administrador', $this->permisos))
                                <!-- Admin can see everything -->
                                <li class="w-full text-center">
                                    <a href="javascript:void(0)"
                                        class="flex items-center justify-center px-1 py-1 font-medium text-center text-gray-500 border-b-2 border-transparent rounded-md hover:text-gray-800 active:bg-[#8492a6] active tablink whitespace-nowrap"
                                        data-tab="tabs-with-underline-1" role="tab">Pedidos
                                        <span class="w-5 h-5 text-white bg-purple-600 rounded-full">
                                            {{ count($NotiPedido) }}
                                        </span>
                                    </a>
                                </li>
                                <li class="w-full text-center">
                                    <a href="javascript:void(0)"
                                        class="flex items-center justify-center px-1 py-1 font-medium text-center text-gray-500 border-b-2 border-transparent rounded-md hover:text-gray-800 active:bg-[#8492a6] tablink whitespace-nowrap"
                                        data-tab="tabs-with-underline-2" role="tab">Citas
                                        <span class="w-5 h-5 text-white bg-purple-600 rounded-full">
                                            {{ count($NotiCita) }}
                                        </span>
                                    </a>
                                </li>
                                <li class="w-full text-center">
                                    <a href="javascript:void(0)"
                                        class="flex items-center justify-center px-1 py-1 font-medium text-center text-gray-500 border-b-2 border-transparent rounded-md hover:text-gray-800 active:bg-[#8492a6] tablink whitespace-nowrap"
                                        data-tab="tabs-with-underline-3" role="tab">Novedades
                                        <span class="w-5 h-5 text-white bg-purple-600 rounded-full">
                                            {{ count($NotiNovedad) }}
                                        </span>
                                    </a>
                                </li>
                            @elseif (in_array('Cajero/Vendedor', $this->permisos))
                                <!-- Cajero/Vendedor can only see Pedidos -->
                                <li class="w-full text-center">
                                    <a href="javascript:void(0)"
                                        class="flex items-center justify-center px-1 py-1 font-medium text-center text-gray-500 border-b-2 border-transparent rounded-md hover:text-gray-800 active:bg-[#8492a6] active tablink whitespace-nowrap"
                                        data-tab="tabs-with-underline-1" role="tab">Pedidos
                                        <span class="w-5 h-5 text-white bg-purple-600 rounded-full">
                                            {{ count($NotiPedido) }}
                                        </span>
                                    </a>
                                </li>
                            @elseif (in_array('Veterinario', $this->permisos))
                                <!-- Veterinario can only see Citas -->
                                <li class="w-full text-center">
                                    <a href="javascript:void(0)"
                                        class="flex items-center justify-center px-1 py-1 font-medium text-center text-gray-500 border-b-2 border-transparent rounded-md hover:text-gray-800 active:bg-[#8492a6] tablink whitespace-nowrap"
                                        data-tab="tabs-with-underline-2" role="tab">Citas
                                        <span class="w-5 h-5 text-white bg-purple-600 rounded-full">
                                            {{ count($NotiCita) }}
                                        </span>
                                    </a>
                                </li>
                            @else
                                <!-- Cliente can only see Novedades -->
                                <li class="w-full text-center">
                                    <a href="javascript:void(0)"
                                        class="flex items-center justify-center px-1 py-1 font-medium text-center text-gray-500 border-b-2 border-transparent rounded-md hover:text-gray-800 active:bg-[#8492a6] tablink whitespace-nowrap"
                                        data-tab="tabs-with-underline-3" role="tab">Novedades
                                        <span class="w-5 h-5 text-white bg-purple-600 rounded-full">
                                            {{ count($NotiNovedad) }}
                                        </span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="mt-5">
                        @if (in_array('Administrador', $this->permisos))
                            <!-- Admin can see everything: Pedidos, Citas, and Novedades -->
                            <div id="tabs-with-underline-1" role="tabpanel" aria-labelledby="tabs-with-underline-item-1"
                                class="tabcontent">
                                <div class="space-y-6">
                                    @forelse ($NotiPedido as $noti)
                                        <div class="bg-white border border-gray-200 rounded-lg shadow-md">
                                            <div class="p-4 md:flex md:items-center">
                                                <div class="flex-1 space-y-1">
                                                    <p class="text-gray-700 text-md">{{ $noti['data']['mensaje'] }}</p>
                                                    <p class="text-sm font-semibold text-gray-900">
                                                        {{ $noti['data']['codigo_operacion'] }}</p>
                                                    <span>{{ $noti['created_at'] }}</span>
                                                </div>
                                                <div class="mt-4 md:mt-0 md:ml-4">
                                                    <button wire:click='MarcarLeidoPedidio("{{ $noti['id'] }}")'
                                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m4.5 12.75 6 6 9-13.5" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="w-full py-4 text-center text-gray-400">No hay notificacines nuevas</p>
                                        <h1>Leido:</h1>
                                        @foreach ($NotiPedidoAll as $notii)
                                            <div class="bg-white border border-gray-200 rounded-lg shadow-md">
                                                <div class="p-4 md:flex md:items-center">
                                                    <div class="flex-1 space-y-1">
                                                        <p class="text-gray-700 text-md">
                                                            {{ $notii['data']['mensaje'] }}</p>
                                                        <p class="text-sm font-semibold text-gray-900">
                                                            {{ $notii['data']['codigo_operacion'] }}</p>
                                                        <span>{{ $notii['updated_at'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforelse
                                </div>
                            </div>

                            <div id="tabs-with-underline-2" role="tabpanel" aria-labelledby="tabs-with-underline-item-2"
                                class="tabcontent">
                                <div class="space-y-6">
                                    @forelse ($NotiCita as $noti)
                                        <div class="bg-white border border-gray-200 rounded-lg shadow-md">
                                            <div class="p-4 md:flex md:items-center">
                                                <div class="flex-1 space-y-1">
                                                    <p class="text-gray-700 text-md">{{ $noti['data']['mensaje'] }}</p>
                                                    <p class="text-sm font-semibold text-gray-900">
                                                        {{ $noti['data']['id_mascota'] }}</p>
                                                    <span>{{ $noti['created_at'] }}</span>
                                                </div>
                                                <div class="mt-4 md:mt-0 md:ml-4">
                                                    <button wire:click='MarcarLeidoCitas("{{ $noti['id'] }}")'
                                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="size-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m4.5 12.75 6 6 9-13.5" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="w-full py-4 text-center text-gray-400">No hay notificacines nuevas
                                        </p>
                                        <h1>Leido:</h1>
                                        @foreach ($NotiCitaAll as $notii)
                                            <div class="bg-white border border-gray-200 rounded-lg shadow-md">
                                                <div class="p-4 md:flex md:items-center">
                                                    <div class="flex-1 space-y-1">
                                                        <p class="text-gray-700 text-md">
                                                            {{ $notii['data']['mensaje'] }}</p>
                                                        <p class="text-sm font-semibold text-gray-900">
                                                            {{ $notii['data']['id_mascota'] }}</p>
                                                        <span>{{ $notii['updated_at'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforelse
                                </div>
                            </div>

                            <div id="tabs-with-underline-3" role="tabpanel"
                                aria-labelledby="tabs-with-underline-item-3" class="tabcontent">
                                <div class="space-y-6">
                                    @forelse ($NotiNovedad as $noti)
                                        <div class="bg-white border border-gray-200 rounded-lg shadow-md">
                                            <div class="p-4 md:flex md:items-center">
                                                <div class="flex-1 space-y-1">
                                                    <p class="text-gray-700 text-md">{{ $noti['data']['mensaje'] }}
                                                    </p>
                                                    <p class="text-sm font-semibold text-gray-900">
                                                        {{ $noti['data']['estado'] }}</p>
                                                    <p class="text-sm font-semibold text-gray-900">
                                                        {{ $noti['data']['observaciones'] }}</p>
                                                    <span>{{ $noti['created_at'] }}</span>
                                                </div>
                                                <div class="mt-4 md:mt-0 md:ml-4">
                                                    <button wire:click='MarcarLeidoNovedades("{{ $noti['id'] }}")'
                                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="size-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m4.5 12.75 6 6 9-13.5" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="w-full py-4 text-center text-gray-400">No hay notificacines nuevas
                                        </p>
                                        <h1>Leido:</h1>
                                        @foreach ($NotiNovedades as $notii)
                                            <div class="bg-white border border-gray-200 rounded-lg shadow-md">
                                                <div class="p-4 md:flex md:items-center">
                                                    <div class="flex-1 space-y-1">
                                                        <p class="text-gray-700 text-md">
                                                            {{ $notii['data']['mensaje'] }}</p>
                                                        <p class="text-sm font-semibold text-gray-900">
                                                            {{ $notii['data']['estado'] }}</p>
                                                        <p class="text-sm font-semibold text-gray-900">
                                                            {{ $notii['data']['observaciones'] }}</p>
                                                        <span>{{ $notii['updated_at'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforelse
                                </div>
                            </div>
                        @elseif (in_array('Cajero/Vendedor', $this->permisos))
                            <!-- Cajero/Vendedor can only see Pedidos -->
                            <div id="tabs-with-underline-1" role="tabpanel"
                                aria-labelledby="tabs-with-underline-item-1" class="tabcontent">
                                <div class="space-y-6">
                                    @forelse ($NotiPedido as $noti)
                                        <div class="bg-white border border-gray-200 rounded-lg shadow-md">
                                            <div class="p-4 md:flex md:items-center">
                                                <div class="flex-1 space-y-1">
                                                    <p class="text-gray-700 text-md">{{ $noti['data']['mensaje'] }}
                                                    </p>
                                                    <p class="text-sm font-semibold text-gray-900">
                                                        {{ $noti['data']['codigo_operacion'] }}</p>
                                                    <span>{{ $noti['created_at'] }}</span>
                                                </div>
                                                <div class="mt-4 md:mt-0 md:ml-4">
                                                    <button wire:click='MarcarLeidoPedidio("{{ $noti['id'] }}")'
                                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="size-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m4.5 12.75 6 6 9-13.5" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="w-full py-4 text-center text-gray-400">No hay notificacines nuevas
                                        </p>
                                        <h1>Leido:</h1>
                                        @foreach ($NotiPedidoAll as $notii)
                                            <div class="bg-white border border-gray-200 rounded-lg shadow-md">
                                                <div class="p-4 md:flex md:items-center">
                                                    <div class="flex-1 space-y-1">
                                                        <p class="text-gray-700 text-md">
                                                            {{ $notii['data']['mensaje'] }}</p>
                                                        <p class="text-sm font-semibold text-gray-900">
                                                            {{ $notii['data']['codigo_operacion'] }}</p>
                                                        <span>{{ $notii['updated_at'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforelse
                                </div>
                            </div>
                        @elseif (in_array('Veterinario', $this->permisos))
                            <!-- Veterinario can only see Citas -->
                            <div id="tabs-with-underline-2" role="tabpanel"
                                aria-labelledby="tabs-with-underline-item-2" class="tabcontent">
                                <div class="space-y-6">
                                    @forelse ($NotiCita as $noti)
                                        <div class="bg-white border border-gray-200 rounded-lg shadow-md">
                                            <div class="p-4 md:flex md:items-center">
                                                <div class="flex-1 space-y-1">
                                                    <p class="text-gray-700 text-md">{{ $noti['data']['mensaje'] }}
                                                    </p>
                                                    <p class="text-sm font-semibold text-gray-900">
                                                        {{ $noti['data']['id_mascota'] }}</p>
                                                    <span>{{ $noti['created_at'] }}</span>
                                                </div>
                                                <div class="mt-4 md:mt-0 md:ml-4">
                                                    <button wire:click='MarcarLeidoCitas("{{ $noti['id'] }}")'
                                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="size-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m4.5 12.75 6 6 9-13.5" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="w-full py-4 text-center text-gray-400">No hay notificacines nuevas
                                        </p>
                                        <h1>Leido:</h1>
                                        @foreach ($NotiCitasAll as $notii)
                                            <div class="bg-white border border-gray-200 rounded-lg shadow-md">
                                                <div class="p-4 md:flex md:items-center">
                                                    <div class="flex-1 space-y-1">
                                                        <p class="text-gray-700 text-md">
                                                            {{ $notii['data']['mensaje'] }}</p>
                                                        <p class="text-sm font-semibold text-gray-900">
                                                            {{ $notii['data']['id_mascota'] }}</p>
                                                        <span>{{ $notii['updated_at'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforelse
                                </div>
                            </div>
                        @elseif (in_array('Cliente', $this->permisos))
                            <!-- Cliente can only see Novedades -->
                            <div id="tabs-with-underline-3" role="tabpanel"
                                aria-labelledby="tabs-with-underline-item-3" class="tabcontent">
                                <div class="space-y-6">
                                    @forelse ($NotiNovedad as $noti)
                                        <div class="bg-white border border-gray-200 rounded-lg shadow-md">
                                            <div class="p-4 md:flex md:items-center">
                                                <div class="flex-1 space-y-1">
                                                    <p class="text-gray-700 text-md">{{ $noti['data']['mensaje'] }}
                                                    </p>
                                                    <p class="text-sm font-semibold text-gray-900">
                                                        {{ $noti['data']['estado'] }}</p>
                                                    <p class="text-sm font-semibold text-gray-900">
                                                        {{ $noti['data']['observaciones'] }}</p>
                                                    <span>{{ $noti['created_at'] }}</span>
                                                </div>
                                                <div class="mt-4 md:mt-0 md:ml-4">
                                                    <button wire:click='MarcarLeidoNovedades("{{ $noti['id'] }}")'
                                                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="size-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m4.5 12.75 6 6 9-13.5" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="w-full py-4 text-center text-gray-400">No hay notificacines nuevas
                                        </p>
                                        <h1>Leido:</h1>
                                        @foreach ($NotiNovedades as $notii)
                                            <div class="bg-white border border-gray-200 rounded-lg shadow-md">
                                                <div class="p-4 md:flex md:items-center">
                                                    <div class="flex-1 space-y-1">
                                                        <p class="text-gray-700 text-md">
                                                            {{ $notii['data']['mensaje'] }}</p>
                                                        <p class="text-sm font-semibold text-gray-900">
                                                            {{ $notii['data']['estado'] }}</p>
                                                        <p class="text-sm font-semibold text-gray-900">
                                                            {{ $notii['data']['observaciones'] }}</p>
                                                        <span>{{ $notii['updated_at'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforelse
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
                @else
                <p class="w-full py-4 text-center text-gray-400">No hay notificacines nuevas</p>
                @endif
            </div>
        </ul>
    </div>
</div>
