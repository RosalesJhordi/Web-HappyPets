<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HappyPets - Carrito</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
    <script src="https://kit.fontawesome.com/a22afade38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/App.css') }}">
    @livewireStyles()
</head>

<body class="bg-gray-100 relative">
    <a href="{{route('ShowServicio')}}"
        class="fixed bottom-2 left-2 z-50 w-16 h-16 bg-secondary flex justify-center items-center text-white rounded-full">
        <div class="indicator text-2xl">
            @livewire('carrito.carrito-count')
            <i class="fa-solid fa-cart-shopping"></i>
        </div>
    </a>
    <button onclick="toggleModal()"
        class="fixed bottom-20 left-2 z-50 w-16 h-16 bg-primary flex justify-center items-center text-white rounded-full">
        <div class="indicator text-2xl">
            <i class="fa-solid fa-robot"></i>
        </div>
    </button>


    <div id="chatModal"
        class="fixed left-2 bottom-24 hidden bg-white rounded-md items-center justify-center border z-50 xl:w-1/3 md:w-1/2"
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
    @livewire('carrito.show-carrito')
    @livewireScripts()
</body>

</html>
