<!DOCTYPE html>
<html lang="en" data-theme='light'>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HappyPets - Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
    <script src="https://kit.fontawesome.com/a22afade38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/App.css') }}">
    @livewireStyles()
</head>

<body class="relative bg-gray-100">
    <a href="{{route('ShowCarrito')}}"
        class="fixed z-50 flex items-center justify-center w-16 h-16 text-white rounded-full bottom-2 left-2 bg-secondary">
        <div class="text-2xl indicator">
            @livewire('carrito.carrito-count')
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
    </a>
    <button onclick="toggleModal()"
        class="fixed z-50 flex items-center justify-center w-16 h-16 text-white rounded-full bottom-20 left-2 bg-primary">
        <div class="text-2xl indicator">
            <i class="fa-solid fa-robot"></i>
        </div>
    </button>


    <div id="chatModal"
        class="fixed z-50 items-center justify-center hidden bg-white border rounded-md left-2 bottom-24 xl:w-1/3 md:w-1/2"
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
    @livewire('productos.show', ['id_producto' => $producto['id']])
    @livewireScripts()
</body>

</html>
