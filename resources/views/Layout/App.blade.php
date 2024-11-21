<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HappyPets - @yield('titulo')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('img/logo.jpg') }}" type="image/png">
    @vite('resources/css/app.css')
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'morado-oscuro': '#805395',
                        'morado-claro': '#A881B7',
                        'rosa': "#E94282",
                    },
                }
            }
        }
    </script>

    <script src="https://kit.fontawesome.com/a22afade38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/App.css') }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    @livewireStyles

</head>

<body class="relative">

    <button onclick="toggleModal()"
        class="fixed z-50 flex items-center justify-center w-16 h-16 text-white rounded-full bottom-20 right-2 bg-primary">
        <div class="text-2xl indicator">
            <i class="fa-solid fa-robot"></i>
        </div>
    </button>

    <div id="chatModal"
        class="fixed z-50 h-[50vh] items-center justify-center hidden bg-white shadow-2xl rounded-md md:w-1/2 w-[90%] right-2 bottom-24 xl:w-1/4"
        style="height: 50vh;>
        <div class="w-full bg-white rounded-lg shadow-lg">
        <div class="flex items-center justify-between w-full p-2 px-4 bg-blue-600 rounded-md">
            <h2 class="font-bold text-white">HappyBot</h2>
            <button class="text-2xl text-white hover:text-gray-300" onclick="toggleModal()">&times;</button>
        </div>
        @livewire('chat-bot')
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('chatModal');
            modal.classList.toggle('hidden');
        }
    </script>

    <nav class="sticky top-0 z-50 bg-white shadow-md">
        <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">

                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <div class="drawer">
                        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
                        <div class="flex flex-col drawer-content">
                            <div class="flex-none lg:hidden">
                                <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="inline-block w-6 h-6 stroke-current">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                </label>
                            </div>

                        </div>
                        <div class="z-50 drawer-side">
                            <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
                            <ul class="z-50 flex flex-col items-center justify-start min-h-full p-4 bg-white menu w-96">
                                <div class="flex items-center justify-center">
                                    <img src="{{ asset('img/logo.jpg') }}" alt="logo" class="py-5 w-60 ">
                                </div>
                                <div class="flex flex-col items-center w-full h-full space-x-4">
                                    <a href="{{ route('/') }}"
                                        class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4
                                         hover:border-blue-600 {{ Route::is('/') ? 'border-blue-600' : 'border-transparent' }}"
                                        aria-current="page">Inicio</a>
                                    <a href="{{ route('Productos') }}"
                                        class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4
                                        hover:border-blue-600 {{ Route::is('Productos') ? 'border-blue-600' : 'border-transparent' }}">Productos</a>
                                    <a href="{{ route('Servicios') }}"
                                        class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4 {{ Route::is('Servicios') ? 'border-blue-600' : 'border-transparent' }} hover:border-blue-600">Servicios</a>
                                    <a href="#"
                                        class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4 border-transparent hover:border-blue-600">Sobre
                                        Nosotros</a>
                                    <a href="#"
                                        class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4 border-transparent hover:border-blue-600">Contactanos</a>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="items-center justify-center flex-1 hidden h-16 sm:justify-start sm:flex">

                    <div class="flex items-center flex-shrink-0 py-4">
                        <img class="w-auto h-16" src="{{ asset('img/logo.jpg') }}" alt="Logo HappyPets">
                    </div>

                    <div class="items-center hidden h-full sm:ml-6 sm:block">
                        <div class="flex items-center h-full space-x-4">
                            <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                            <a href="/"
                                class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4 hover:border-blue-600 {{ Route::is('/') ? 'border-blue-600' : 'border-transparent' }}"
                                aria-current="page">Inicio</a>
                            <a href="{{ route('Productos') }}"
                                class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4 hover:border-blue-600 {{ Route::is('Productos') ? 'border-blue-600' : 'border-transparent' }}">Productos</a>
                            <a href="{{ route('Servicios') }}"
                                class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4 hover:border-blue-600 {{ Route::is('Servicios') ? 'border-blue-600' : 'border-transparent' }}">Servicios</a>
                            <a href="#"
                                class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4 hover:border-blue-600">Sobre
                                Nosotros</a>
                            <a href="#"
                                class="flex items-center justify-center h-16 px-3 text-lg font-semibold text-gray-500 border-b-4 hover:border-blue-600">Contactanos</a>
                        </div>
                    </div>
                </div>

                <div
                    class="absolute inset-y-0 right-0 z-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button type="button"
                        class="relative p-1 text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-1 focus:ring-black focus:ring-offset-1 focus:ring-offset-gray-800">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <svg class="w-6 h-6 " fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                    </button>

                    <div class="flex items-center justify-center">
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
        </div>

    </nav>

    @yield('contenido')

    <footer class="w-full bg-white dark:bg-gray-900">
        <div class="max-w-2xl px-4 mx-auto mt-5 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="grid grid-cols-2 gap-8 px-4 py-6 lg:py-8 md:grid-cols-4">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">EMPRESA</h2>
                    <ul class="font-medium text-gray-500 dark:text-gray-400">
                        <li class="mb-4">
                            <a href="#" class=" hover:underline">Sobre Nosotros</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Veterinarios</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">CENTRO DE AYUDA</h2>
                    <ul class="font-medium text-gray-500 dark:text-gray-400">
                        <li class="mb-4">
                            <button onclick="toggleModal()" class="cursor-pointer hover:underline">ChatBot</button>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Facebook</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">WhatsApp</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Llamada telefónica</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">LEGAL</h2>
                    <ul class="font-medium text-gray-500 dark:text-gray-400">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Política de privacidad</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Libro de reclamos</a>
                        </li>
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Términos y condiciones</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Descargas</h2>
                    <ul class="font-medium text-gray-500 dark:text-gray-400">
                        <li class="mb-4">
                            <a href="#" class="hover:underline">Android</a>
                        </li>
                        <li class="mb-4">
                            <a class="text-gray-500 hover:underline">Windows (Proximante)</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-row px-4 py-2 mt-6 bg-gray-100 dark:bg-gray-700 md:items-center md:justify-between">
                <span class="text-sm text-gray-500 dark:text-gray-300 sm:text-center">© 2024 <a
                        href="https://flowbite.com/">HappyPets-Hco</a>. Todos los derechos eservados.
                </span>
            </div>
            <div class="flex flex-row px-4 py-2 bg-gray-100 dark:bg-gray-700 md:items-center md:justify-between">
                <span class="text-sm text-gray-500 dark:text-gray-300 sm:text-center">Desarollado por: <a
                        href="" class="font-bold">RJ ENTERPRISES™</a>
                </span>
            </div>
        </div>
    </footer>
    @livewireScripts
</body>

</html>
