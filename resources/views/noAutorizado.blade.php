<!DOCTYPE html>
<html lang="es" data-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HappyPets</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/App.css') }}">
    <script defer src="https://app.embed.im/snow.js"></script>

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
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-800">
    <section class="w-full max-w-xl p-8 bg-white rounded-md shadow-md ">
        <div class="text-center">
            <h1 class="mb-4 text-6xl font-extrabold tracking-tight text-blue-600 lg:text-9xl">401</h1>
            <p class="mb-4 text-3xl font-bold tracking-tight text-gray-900 lg:text-5xl">No Autorizado</p>
            <p class="mb-4 text-lg font-semibold text-gray-500 lg:text-2xl">
                La solicitud requiere autenticación del usuario, pero no se ha proporcionado o faltan permisos necesarios.
            </p>
            <a href="/" class="inline-block px-6 py-3 text-sm font-medium text-white bg-blue-600 rounded-md lg:text-lg hover:bg-blue-500">
                Volver a Inicio
            </a>
        </div>
    </section>
</body>

</html>
