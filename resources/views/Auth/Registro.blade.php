<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HappyPets - Registro</title>
    @vite(['resources/css/app.css'])
    <script src="https://kit.fontawesome.com/a22afade38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/App.css') }}">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/flowbite@latest/dist/flowbite.js"></script>
    @livewireStyles

<body class="relative flex items-center justify-center h-screen">
    <div
        class="absolute z-50 flex flex-col items-center justify-center w-full max-w-md py-10 bg-white rounded-md sm:max-w-lg md:max-w-xl lg:max-w-xl">
        <img src="{{ asset('img/logo.jpg') }}" alt="logo happypets" class="py-5 mx-auto w-80">

        @livewire('auth.registro')
        @livewireScripts()
    </div>

    <video src="{{ asset('media/ct.mp4') }}" autoplay loop muted class="h-full w-[100%] hidden sm:flex object-cover">
        Tu navegador no admite la etiqueta de video.
    </video>
</body>

</html>
