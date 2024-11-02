<div>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start rtl:justify-end">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd"
                                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                            </path>
                        </svg>
                    </button>
                    <a href="/" class="flex ms-2 md:me-24">
                        <img src="{{ asset('img/logo.jpg') }}" alt="logo" class="h-10 me-3" alt="FlowBite Logo" />
                    </a>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center ms-3">
                        <div class="text-2xl indicator">
                            <span class="text-xs indicator-item badge badge-primary">0</span>
                            <i class="fa-regular fa-bell"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
        aria-label="Sidebar">
        <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="{{ route('Admin') }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg  group {{ Route::is('Admin') ? 'bg-blue-600 text-white hover:bg-blue-500' : 'text-gray-900 hover:bg-gray-200' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-6 h-6  {{ Route::is('Admin') ? 'text-white' : 'text-gray-500' }}">
                            <path
                                d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                            <path
                                d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                        </svg>
                        <span class="ms-3">Inicio</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Admin.Productos') }}"
                        class="flex items-center p-2 cursor-pointer rounded-lg {{ Route::is('Admin.Productos') ? 'bg-blue-600 text-white hover:bg-blue-500' : 'text-gray-900 hover:bg-gray-200' }}">
                        <svg class="flex-shrink-0 w-5 h-5 {{ Route::is('Admin.Productos') ? 'text-white' : 'text-gray-500' }} transition duration-75"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 20">
                            <path
                                d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Productos</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('Admin.Servicios') }}"
                        class="flex items-center p-2 rounded-lg {{ Route::is('Admin.Servicios') ? 'bg-blue-600 text-white hover:bg-blue-500' : 'text-gray-900 hover:bg-gray-200' }}">
                        <svg class="flex-shrink-0 w-5 h-5 transition duration-75 {{ Route::is('Admin.Servicios') ? 'text-white' : 'text-gray-500' }} "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 18 18">
                            <path
                                d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Servicios</span>

                    </a>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group {{ Route::is('Admin.Citas.Hoy') | Route::is('Admin.Citas.Semana') | Route::is('Admin.Citas.Mes')  ? 'bg-blue-600 text-white
                         hover:bg-blue-500' : 'text-gray-900 hover:bg-gray-200'  }}"
                        aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="flex-shrink-0 w-6 h-6  {{ Route::is('Admin.Citas.Hoy') | Route::is('Admin.Citas.Semana') | Route::is('Admin.Citas.Mes')  ? 'text-white' : 'text-gray-500' }} transition duration-75 ">
                            <path fill-rule="evenodd"
                                d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z"
                                clip-rule="evenodd" />
                        </svg>

                        <span class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">Citas</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('Admin.Citas.Hoy') }}"
                                class="flex items-center w-full gap-2 p-2 text-gray-600 transition duration-75 rounded-lg pl-11 group hover:bg-gray-200">
                                <i class="text-gray-500 fa-solid fa-calendar-day"></i>
                                Hoy
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Admin.Citas.Semana') }}"
                                class="flex items-center w-full gap-2 p-2 text-gray-600 transition duration-75 rounded-lg pl-11 group hover:bg-gray-200">
                                <i class="text-gray-500 fa-solid fa-calendar-week "></i>
                                Esta Semana</a>
                        </li>
                        <li>
                            <a href="{{ route('Admin.Citas.Mes') }}"
                                class="flex items-center w-full gap-2 p-2 text-gray-600 transition duration-75 rounded-lg pl-11 group hover:bg-gray-200">
                                <i class="text-gray-500 fa-regular fa-calendar "></i>
                                Este Mes</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('Admin.Mascotas')}}"
                        class="flex items-center p-2 rounded-lg group {{ Route::is('Admin.Mascotas') ? 'bg-blue-600 text-white hover:bg-blue-500' : 'text-gray-900 hover:bg-gray-200' }}">
                        <i
                            class="w-6 h-6 text-lg {{ Route::is('Admin.Mascotas')  ? 'text-white' : 'text-gray-500' }} fa-solid fa-dog"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Mascotas</span>
                    </a>
                </li>

                <li>
                    <button type="button"
                        class="flex items-center w-full p-2 text-base transition duration-75 rounded-lg group {{ Route::is('Admin.Clientes') | Route::is('Admin.Empleados')  ? 'bg-blue-600 text-white hover:bg-blue-500' : 'text-gray-900 hover:bg-gray-200' }}"
                        aria-controls="dropdown-example2" data-collapse-toggle="dropdown-example2">
                        <svg class="flex-shrink-0 w-5 h-5 {{ Route::is('Admin.Clientes')  | Route::is('Admin.Empleados') ? 'text-white' : 'text-gray-500' }}  transition duration-75 "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>

                        <span class="flex-1 text-left ms-3 rtl:text-right whitespace-nowrap">Usuarios</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <ul id="dropdown-example2" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('Admin.Clientes') }}"
                                class="flex items-center w-full gap-2 p-2 text-gray-600 transition duration-75 rounded-lg pl-11 group hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="text-gray-500 size-6">
                                    <path fill-rule="evenodd"
                                        d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                </svg>
                                Clientes
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('Admin.Empleados') }}"
                                class="flex items-center w-full gap-2 p-2 text-gray-600 transition duration-75 rounded-lg pl-11 group hover:bg-gray-200">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="text-gray-500 size-6 ">
                                    <path fill-rule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                        clip-rule="evenodd" />
                                </svg>
                                Empleados</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="text-gray-500 size-6">
                            <path fill-rule="evenodd"
                                d="M7.5 3.75A1.5 1.5 0 0 0 6 5.25v13.5a1.5 1.5 0 0 0 1.5 1.5h6a1.5 1.5 0 0 0 1.5-1.5V15a.75.75 0 0 1 1.5 0v3.75a3 3 0 0 1-3 3h-6a3 3 0 0 1-3-3V5.25a3 3 0 0 1 3-3h6a3 3 0 0 1 3 3V9A.75.75 0 0 1 15 9V5.25a1.5 1.5 0 0 0-1.5-1.5h-6Zm10.72 4.72a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1 0 1.06l-3 3a.75.75 0 1 1-1.06-1.06l1.72-1.72H9a.75.75 0 0 1 0-1.5h10.94l-1.72-1.72a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>


                        <span class="flex-1 ms-3 whitespace-nowrap">Salir</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-2 md:p-4 sm:ml-64">
        <div class="p-2 border-gray-200 md:p-4 mt-14">
            @if (Route::is('Admin'))
                <h1 class="text-2xl font-extrabold text-gray-600">Inicio</h1>
            @elseif (Route::is('Admin.Productos'))
                <h1 class="text-2xl font-extrabold text-gray-600">Productos</h1>
            @elseif (Route::is('Admin.Servicios'))
                <h1 class="text-2xl font-extrabold text-gray-600">Servicios</h1>
            @elseif (Route::is('Admin.Citas.Hoy'))
                <h1 class="text-2xl font-extrabold text-gray-600">Citas Hoy</h1>
            @elseif (Route::is('Admin.Citas.Semana'))
                <h1 class="text-2xl font-extrabold text-gray-600">Citas Semana</h1>
            @elseif (Route::is('Admin.Citas.Mes'))
                <h1 class="text-2xl font-extrabold text-gray-600">Citas Mes</h1>
            @elseif (Route::is('Admin.Mascotas'))
                <h1 class="text-2xl font-extrabold text-gray-600">Mascotas</h1>
            @elseif (Route::is('Admin.Clientes'))
                <h1 class="text-2xl font-extrabold text-gray-600">Clientes</h1>
            @elseif (Route::is('Admin.Empleados'))
                <h1 class="text-2xl font-extrabold text-gray-600">Empleados</h1>
            @endif

            @yield('contenido')
        </div>
    </div>
</div>
