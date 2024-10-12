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

<body class="relative">
    <a href="{{route('ShowCarrito')}}"
        class="fixed bottom-2 right-2 z-50 w-16 h-16 bg-secondary flex justify-center items-center text-white rounded-full">
        <div class="indicator text-2xl">
            @livewire('carrito.carrito-count')
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
    </a>
    <button onclick="toggleModal()"
        class="fixed bottom-20 right-2 z-50 w-16 h-16 bg-primary flex justify-center items-center text-white rounded-full">
        <div class="indicator text-2xl">
            <i class="fa-solid fa-robot"></i>
        </div>
    </button>


    <div id="chatModal"
        class="fixed right-2 bottom-24 hidden bg-white rounded-md items-center justify-center border z-50 xl:w-1/3 md:w-1/2"
        style="height: 50vh;>
        <div class="bg-white rounded-lg shadow-lg w-full">
            <div class="flex w-full justify-between items-center bg-blue-600 p-4 rounded-md">
                <h2 class="text-white font-bold">Chatbot</h2>
                <button class="text-white text-2xl hover:text-gray-300" onclick="toggleModal()">&times;</button>
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


    <header
        class="shadow-md p-1 px-20 flex flex-col md:flex-row justify-between items-center sticky top-0 z-50 bg-white">
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
                    <a href="Registro" wire:navigate class=" w-90">
                        <span class="bg-orange-600 px-3 text-white p-2 rounded-full w-full">
                            Ingresar
                            <i class="fa-solid fa-arrow-right"></i>
                        </span>
                    </a>
                </div>
            @endif
        </nav>
    </header>
    @yield('contenido')
    <footer class="footer bg-neutral text-neutral-content p-10">
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
