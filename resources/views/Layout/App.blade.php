<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HappyPets - @yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css'])
    <script src="https://kit.fontawesome.com/a22afade38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/App.css') }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css"  rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</head>

<body class="relative">
    {{-- <a href="{{ route('ShowCarrito') }}"
        class="fixed z-50 flex items-center justify-center w-16 h-16 text-white rounded-full bottom-2 right-2 bg-secondary">
        <div class="text-2xl indicator">
            @livewire('carrito.carrito-count')
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
    </a> --}}
    <button onclick="toggleModal()"
        class="fixed z-50 flex items-center justify-center w-16 h-16 text-white rounded-full bottom-20 right-2 bg-primary">
        <div class="text-2xl indicator">
            <i class="fa-solid fa-robot"></i>
        </div>
    </button>


    <div id="chatModal"
        class="fixed z-50 items-center justify-center hidden bg-white border rounded-md right-2 bottom-24 xl:w-1/3 md:w-1/2"
        style="height: 50vh;>
        <div class="w-full bg-white rounded-lg shadow-lg">
        <div class="flex items-center justify-between w-full p-4 bg-blue-600 rounded-md">
            <h2 class="font-bold text-white">Chatbot</h2>
            <button class="text-2xl text-white hover:text-gray-300" onclick="toggleModal()">&times;</button>
        </div>
        @livewire('chat-bot')
    </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('chatModal');
            modal.classList.toggle('hidden');
        }
    </script>

    <nav class="sticky top-0 z-50 bg-white">
        <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">

                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">

                    <button type="button"
                        class="relative inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>

                        <svg class="block w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>

                        <svg class="hidden w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div class="flex items-center justify-center flex-1 h-16 sm:justify-start">

                    <div class="flex items-center flex-shrink-0 py-4">
                        <img class="w-auto h-16" src="{{ asset('img/logo.jpg') }}" alt="Logo HappyPets">
                    </div>

                    <div class="items-center hidden h-full sm:ml-6 sm:block">
                        <div class="flex items-center h-full space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="#"
                                class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4 border-transparent hover:border-blue-600"
                                aria-current="page">Inicio</a>
                            <a href="#"
                                class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4 border-transparent hover:border-blue-600">Productos</a>
                            <a href="#"
                                class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4 border-transparent hover:border-blue-600">Sobre
                                Nosotros</a>
                            <a href="#"
                                class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4 border-transparent hover:border-blue-600">Contactanos</a>
                        </div>
                    </div>
                </div>

                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button type="button"
                        class="relative p-1 text-gray-400 bg-white rounded-full hover:text-gray-500 focus:outline-none focus:ring-1 focus:ring-black focus:ring-offset-1 focus:ring-offset-gray-800">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <svg class="w-8 h-8 " fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                    </button>

                    @livewire('carrito.carrito-count')

                    @if (Session::has('authToken'))
                        @livewire('datos.datos-usuario')
                    @else
                        <div class="w-auto p-1 mt-2 md:mt-0">
                            <a href="Registro" wire:navigate class="w-96">
                                <span class="w-full p-2 px-3 text-white rounded-md bg-rosa">
                                    Ingresar
                                    <i class="fa-solid fa-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        {{-- <div class="sm:hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="#" class="block px-3 py-2 text-base font-medium text-white bg-gray-900 rounded-md"
                    aria-current="page">Inicio</a>
                <a href="#"
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Productos</a>
                <a href="#"
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Sobre Nosotros</a>
                <a href="#"
                    class="block px-3 py-2 text-base font-medium text-gray-300 rounded-md hover:bg-gray-700 hover:text-white">Contactanos</a>
            </div>
        </div> --}}
    </nav>

    @yield('contenido')
    <footer class="p-10 footer bg-neutral text-neutral-content">
        <aside>
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="w-40">
            <p>
                ACME Industries Ltd.
                <br />
                Providing reliable tech since 1992
            </p>
        </aside>
        <nav>
            <h6 class="footer-title">Social</h6>
            <div class="grid grid-flow-col gap-4">
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="fill-current">
                        <path
                            d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z">
                        </path>
                    </svg>
                </a>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="fill-current">
                        <path
                            d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z">
                        </path>
                    </svg>
                </a>
                <a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        class="fill-current">
                        <path
                            d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z">
                        </path>
                    </svg>
                </a>
            </div>
        </nav>
    </footer>
</body>

</html>
