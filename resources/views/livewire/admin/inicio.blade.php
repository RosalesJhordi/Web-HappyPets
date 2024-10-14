{{-- admin.inicio --}}
<div class="relative flex">
    <style>
        .submenu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        input:checked~.submenu {
            max-height: 500px;
        }
    </style>
    <aside class="sticky top-0 z-50 h-screen text-gray-400 bg-gray-900 shadow-md" style="width: 18%">
        <img src="{{ asset('img/logo.png') }}" alt="logo" class="px-5 py-5 w-80">
        <ul class="flex flex-col w-full gap-2 px-10 py-10 text-base menu">
            <p class="py-2 text-sm text-gray-400 uppercase">Menu</p>

            <!-- Botón Inicio -->
            <li>
                <a href="Admin"
                    class="{{ $activeButton === 'home' ? 'bg-gray-400 text-white' : 'text-gray-400' }} hover:bg-gray-600  rounded flex items-center gap-2">
                    <i class="fa-solid fa-home"></i>
                    Inicio
                </a>
            </li>

            <!-- Botón Servicios / Productos -->
            <li>
                <a wire:click.prevent='setActive("products")'
                    class="{{ $activeButton === 'products' ? 'bg-gray-400 text-white' : 'text-gray-400' }} hover:bg-gray-600 rounded flex items-center gap-2">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    Productos
                </a>
            </li>

            <!-- Botón Citas -->
            <li>
                <label for="submenu2-toggle"
                    class="flex items-center justify-between text-gray-400 rounded-md cursor-pointer hover:bg-gray-600">
                    <span>
                        <i class="fa-solid fa-calendar-alt"></i>
                        Citas
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path id="icon2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7"></path>
                    </svg>
                </label>
                <input type="checkbox" id="submenu2-toggle" class="hidden" />
                <ul class="pl-4 submenu">
                    <li>
                        <a wire:click.prevent='setActive("today")'
                            class="{{ $activeButton === 'today' ? 'bg-gray-400 text-white' : 'text-gray-400' }} hover:bg-gray-600  rounded flex items-center gap-2">
                            <i class="fa-solid fa-calendar-day"></i>
                            Hoy
                        </a>
                    </li>
                    <li>
                        <a wire:click.prevent='setActive("week")'
                            class="{{ $activeButton === 'week' ? 'bg-gray-400 text-white' : 'text-gray-400' }} hover:bg-gray-600  rounded flex items-center gap-2">
                            <i class="fa-solid fa-calendar-week"></i>
                            Esta Semana
                        </a>
                    </li>
                    <li>
                        <a wire:click.prevent='setActive("month")'
                            class="{{ $activeButton === 'month' ? 'bg-gray-400 text-white' : 'text-gray-400' }} hover:bg-gray-600  rounded flex items-center gap-2">
                            <i class="fa-regular fa-calendar"></i>
                            Este mes
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Botón mascotas -->
            <li>
                <a wire:click.prevent='setActive("pets")'
                    class="{{ $activeButton === 'pets' ? 'bg-gray-400 text-white' : 'text-gray-400' }} hover:bg-gray-600 rounded flex items-center gap-2">
                    <i class="fa-solid fa-dog"></i>
                    Mascotas
                </a>
            </li>

            <!-- Botón Estado -->
            <li>
                <a wire:click.prevent='setActive("status")'
                    class="{{ $activeButton === 'status' ? 'bg-gray-400 text-white' : 'text-gray-400' }} rounded flex items-center gap-2 hover:bg-gray-600 ">
                    <i class="fa-solid fa-chart-bar"></i>
                    Estado
                </a>
            </li>

            <!-- Botón Usuarios -->
            <li>
                <label for="submenu3-toggle"
                    class="flex items-center justify-between text-gray-400 cursor-pointer hover:bg-gray-600">
                    <span>
                        <i class="fa-solid fa-users"></i>
                        Usuarios
                    </span>
                    <svg class="w-4 h-4 transition-transform duration-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path id="icon2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 9l-7 7-7-7"></path>
                    </svg>
                </label>
                <input type="checkbox" id="submenu3-toggle" class="hidden" />
                <ul class="pl-4 submenu">
                    <li>
                        <a wire:click.prevent='setActive("clients")'
                            class="{{ $activeButton === 'clients' ? 'bg-gray-200' : 'text-gray-400' }} p-2 rounded flex items-center gap-2 hover:bg-gray-600 hover:text-white">
                            <i class="fa-solid fa-user-group"></i>
                            Clientes
                        </a>
                    </li>
                    <li>
                        <a wire:click.prevent='setActive("employees")'
                            class="{{ $activeButton === 'employees' ? 'bg-gray-400 text-white' : 'text-gray-400' }} rounded flex items-center gap-2 hover:bg-gray-600">
                            <i class="fa-solid fa-user-doctor"></i>
                            Empleados
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Botón Información -->
            <li>
                <a wire:click.prevent='setActive("info")'
                    class="{{ $activeButton === 'info' ? 'bg-gray-400 text-white' : 'text-gray-400' }} rounded flex items-center gap-2 hover:bg-gray-600">
                    <i class="fa-solid fa-info-circle"></i>
                    Información
                </a>
            </li>

            <!-- Botón Salir -->
            <li>
                <a href="/" class="flex items-center gap-2 text-gray-400 hover:bg-gray-600">
                    <i class="fa-solid fa-sign-out-alt"></i>
                    Salir
                </a>
            </li>
        </ul>

        <div class="absolute w-full text-center bottom-1">
            <p class="text-xs ">HappyPets - 2024</p>
            <p class="text-xs">Todos los derechos reservados - &copy</p>
            <p class="text-xs text-gray-400">RosalesJhon &Jsercy;&hamilt;</p>
        </div>
    </aside>

    <div class="h-full px-5" style="width: 82%;">
        <div class="sticky top-0 z-50 flex items-center justify-between w-full py-5 bg-white border-b-2 navbar">
            @if ($activeButton === 'home')
                <h1 class="text-2xl font-extrabold">Inicio</h1>
            @elseif ($activeButton === 'products')
                <h1 class="text-2xl font-extrabold">Productos</h1>
            @elseif ($activeButton === 'pets')
                <h1 class="text-2xl font-extrabold">Mascotas</h1>
            @endif
            <div class="text-2xl indicator">
                <span class="text-xs indicator-item badge badge-primary">0</span>
                <i class="fa-regular fa-bell"></i>
            </div>
        </div>

        {{-- contenido --}}

        @if ($activeButton === 'home')
            @livewire('admin.views.inicio')
        @elseif ($activeButton === 'products')
            @livewire('admin.productos.productos')
        @else
        @endif
    </div>
</div>
</div>
