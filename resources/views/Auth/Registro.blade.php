<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HappyPets - Registro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp,container-queries"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('img/logo.jpg') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/pagedone@1.2.2/src/css/pagedone.css " rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/pagedone@1.2.2/src/js/pagedone.js"></script>
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
    @livewireStyles

<body class="relative flex items-center justify-center h-screen">
    <div
        class="absolute z-50 flex flex-col items-center justify-center w-full max-w-md py-10 bg-white rounded-md sm:max-w-lg md:max-w-lg lg:max-w-lg">
        <img src="{{ asset('img/logo.jpg') }}" alt="logo happypets" class="py-5 mx-auto w-80">

        @livewire('auth.registro')
        <button id="btnmodal" data-modal-target="static-modal" data-modal-toggle="static-modal"
            class="block text-gray-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Terminos y condiciones
        </button>

        <!-- Main modal -->
        <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[9999] justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full p-4">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t md:p-5 dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Terminos y Condiciones
                        </h3>
                        <button type="button"
                            class="inline-flex items-center justify-center w-8 h-8 text-sm text-gray-400 bg-transparent rounded-lg hover:bg-gray-200 hover:text-gray-900 ms-auto dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="static-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 space-y-4 md:p-5">
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            Al utilizar los servicios de nuestra clínica veterinaria, es posible que solicitemos datos personales como su DNI, dirección, información de contacto y datos relacionados con sus mascotas. Estos datos son necesarios para brindarle una atención adecuada y personalizada.
                        </p>
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            Le garantizamos que sus datos personales serán tratados de manera confidencial y estarán protegidos de acuerdo con la normativa vigente en materia de protección de datos. No compartiremos su información con terceros sin su consentimiento explícito, salvo en casos requeridos por la ley.
                        </p>
                        <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            En caso de consultas o solicitudes relacionadas con sus datos personales, puede comunicarse con nosotros a través de los canales de atención establecidos. Su privacidad es nuestra prioridad.
                        </p>
                    </div>

                    <!-- Modal footer -->
                    <div class="flex items-center p-4 border-t border-gray-200 rounded-b md:p-5 dark:border-gray-600">
                        <button data-modal-hide="static-modal" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const boton = document.getElementById('btnmodal');

            window.onload = () => {
                setTimeout(() => {
                    boton.click();
                }, 0);
            };
        </script>
        @livewireScripts()
    </div>

    <video src="{{ asset('media/ct.mp4') }}" autoplay loop muted class="h-full w-[100%] hidden sm:flex object-cover">
        Tu navegador no admite la etiqueta de video.
    </video>

</body>

</html>
