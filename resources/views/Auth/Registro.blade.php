<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HappyPets - Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
    <script src="https://kit.fontawesome.com/a22afade38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/App.css') }}">
    @livewireStyles()

<body class="flex items-center justify-center h-screen relative">
    <div class="absolute z-50 bg-white rounded-md flex flex-col items-center justify-center py-10" style="width: 25%;">
        <img src="{{ asset('img/logo.jpg') }}" alt="logo happypets" class="w-80 py-5">
        
        @livewire('auth.registro')
        @livewireScripts()
    </div>
    <video src="{{ asset('media/ct.mp4') }}" autoplay loop muted class="h-full w-[100%] object-cover">
        Tu navegador no admite la etiqueta de video.
    </video>
</body>

</html>
