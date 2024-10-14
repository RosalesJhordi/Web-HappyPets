<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HappyPets</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/js/app.js'])
    <script src="https://kit.fontawesome.com/a22afade38.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/App.css') }}">
    <script defer src="https://app.embed.im/snow.js"></script>
</head>
<body class="flex justify-center items-center h-screen w-full">
    <section class="bg-white rounded-md dark:bg-gray-900 w-1/3">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center">
                <h1 class="mb-4 text-9xl tracking-tight font-extrabold lg:text-9xl text-blue-600 dark:text-primary-500">401</h1>
                <p class="mb-4 text-5xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">No Autorizado</p>
                <p class="mb-4 text-2xl text-gray-500 dark:text-gray-400 font-semibold"> La solicitud requiere autenticación del usuario, pero no se ha proporcionado o faltan permisos necesarios</p>
                <a href="/" class="btn bg-blue-600">Volver a Inicio</a>
            </div>
        </div>
    </section>
</body>
</html>
