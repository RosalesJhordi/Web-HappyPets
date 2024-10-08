<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HappyPets - @yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
    <script src="https://kit.fontawesome.com/a22afade38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/App.css') }}">
</head>

<body>
    <header class="shadow-md p-1 px-20 flex flex-col md:flex-row justify-between items-center sticky top-0 z-50 bg-white">
        <a href="/">
            <img src="{{ asset('img/logo.jpg') }}" alt="Logo" class="w-20 md:w-32 lg:w-40 mb-2 md:mb-0">
        </a>
        <nav class="flex w-auto flex-col md:flex-row gap-2 text-base font-semibold items-center">
            <a href="/" class="p-1 hover:border-b-2 hover:text-gray-400 border-gray-400">Inicio</a>
            <a href="#" class="p-1 hover:border-b-2 hover:text-gray-400 border-gray-400">Productos</a>
            <a href="#" class="p-1 hover:border-b-2 hover:text-gray-400 border-gray-400">Servicios</a>
            <div class="dropdown dropdown-hover">
                <div tabindex="0" role="button" class="m-1 p-1 md:p-2">
                    Más
                    <i class="fa-solid fa-caret-down"></i>
                </div>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                    <li><a>Sobre Nosotros</a></li>
                    <li><a>Contáctanos</a></li>
                </ul>
            </div>
            @if (Session::has('authToken'))
                @livewire('datos.datos-usuario')
            @else
                <div class="p-1 w-auto mt-2 md:mt-0">
                    <a href="Registro" wire:navigate class="p-1 md:p-2 hover:border-b-2 hover:text-gray-500 border-gray-400">Registrarse</a>
                    |
                    <a href="" wire:navigate class=" w-90">
                        <span class="bg-orange-600 px-3 text-white p-2 rounded-full w-full">
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </a>
                </div>
            @endif
        </nav>
    </header>
    @yield('contenido')
</body>
</html>
