<div class="w-full bg-white">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <div class="max-w-xl px-4 py-5 mx-auto sm:px-6 sm:py-10 lg:max-w-5xl lg:px-8">
        <h2 class="text-lg font-bold tracking-tight text-gray-500 lg:text-2xl">Hola: {{ $nombres }}</h2>
        @if ($hist)
            <button class="py-3 mt-3 btn btn-primary" wire:click="ocultarHistorial">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                </svg>
                atras
            </button>
            <h2 class="w-full py-3 text-2xl text-center border-b">
                Historial de la mascota
            </h2>

            <div class="max-w-4xl p-8 mx-auto mt-8 space-y-8 bg-gradient-to-r ">
                <!-- Información de la Mascota -->
                @foreach ($mascotaHistorial['mascotas'] as $historia)
                    <div class="flex items-center justify-center w-full gap-3">
                        <div class="avatar">
                            <div class="h-28 w-60 mask mask-squircle">
                                <img src="{{ 'https://api.happypetshco.com/ServidorMascotas/' . $historia['imagen'] }}"
                                    alt="Imagen servicio {{ $historia['nombre'] }}" class="w-full" />
                            </div>
                        </div>
                    </div>
                    <div class="p-6 mt-8 transition-transform transform bg-white rounded-lg shadow-lg hover:scale-105">
                        <h2 class="pb-4 text-2xl font-semibold text-purple-700 border-b border-purple-300">Datos de
                            Identificación del Paciente</h2>

                        <div class="grid grid-cols-2 gap-4 mt-4">
                            <div>
                                <label class="block font-medium text-purple-600">Nombre:</label>
                                <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                    {{ $historia['nombre'] }}
                                </p>
                            </div>
                            <div>
                                <label class="block font-medium text-purple-600">Edad:</label>
                                <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                    {{ $historia['edad'] }}
                                </p>
                            </div>
                            <div>
                                <label class="block font-medium text-purple-600">Especie:</label>
                                <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                    {{ $historia['especie'] }}
                                </p>
                            </div>
                            <div>
                                <label class="block font-medium text-purple-600">Raza:</label>
                                <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                    {{ $historia['raza'] }}
                                </p>
                            </div>
                            <div>
                                <label class="block font-medium text-purple-600">Sexo:</label>
                                <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                    {{ $historia['sexo'] }}
                                </p>
                            </div>
                            <div>
                                <label class="block font-medium text-purple-600">Estado:</label>
                                <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                    {{ $historia['estado'] }}
                                </p>
                            </div>
                            <div>
                                <label class="block font-medium text-purple-600">Propietario:</label>
                                <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                    {{ $historia['usuario']['nombres'] . ' ' . $historia['usuario']['apellidos'] }}</p>
                            </div>
                            <div>
                                <label class="block font-medium text-purple-600">Teléfono:</label>
                                <p class="p-2 font-semibold text-purple-800 rounded bg-purple-50">
                                    {{ $historia['usuario']['telefono'] }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Historial Clínico de Citas -->
                    @if (isset($historia['citas']) && !empty($historia['citas']))
                        @foreach ($historia['citas'] as $citas)
                            <div
                                class="p-6 mt-4 transition-transform transform bg-white border-l-4 border-purple-500 rounded-lg shadow-lg hover:scale-105">
                                <h2 class="pb-4 text-xl font-semibold text-teal-700 border-b border-teal-300">
                                    {{ $citas['fecha'] . ' - ' . $citas['hora'] }}</h2>

                                <!-- Sección de cada cita -->
                                <div class="p-4 mt-4 space-y-4 rounded-lg shadow-md bg-teal-50">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium text-teal-600">Fecha:</label>
                                            <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                                {{ $citas['fecha'] }}
                                            </p>
                                        </div>
                                        <div>
                                            <label class="block font-medium text-teal-600">Hora:</label>
                                            <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                                {{ $citas['hora'] }}
                                            </p>
                                        </div>
                                        <div>
                                            <label class="block font-medium text-teal-600">Síntomas:</label>
                                            <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                                {{ $citas['sintomas'] }}</p>
                                        </div>
                                        <div>
                                            <label class="block font-medium text-teal-600">Estado:</label>
                                            <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                                {{ $citas['estado'] }}
                                            </p>
                                        </div>
                                        <div>
                                            <label class="block font-medium text-teal-600">Tratamiento:</label>
                                            <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                                {{ $citas['tratamiento'] }}</p>
                                        </div>
                                        <div>
                                            <label class="block font-medium text-teal-600">Importe:</label>
                                            <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">S/.
                                                {{ $citas['importe'] }}</p>
                                        </div>
                                        <div class="col-span-2">
                                            <label class="block font-medium text-teal-600">Observaciones:</label>
                                            <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                                {{ $citas['observaciones'] }}</p>
                                        </div>
                                        <div class="col-span-2">
                                            <label class="block font-medium text-teal-600">Próxima Cita:</label>
                                            <p class="p-2 font-semibold text-teal-800 bg-teal-100 rounded">
                                                {{ $citas['proxima_cita'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fin de la sección de una cita -->
                            </div>
                        @endforeach
                    @else
                        <div class="flex flex-col items-center justify-center w-full space-y-4">
                            <div class="avatar">
                                <div class="w-64 shadow-lg rounded-xl">
                                    <img src="data:image/jpeg;base64,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"
                                        alt="Imagen de historial" />
                                </div>
                            </div>
                            <div class="space-y-2 text-center">
                                <h2 class="text-2xl font-semibold">Sin historial de Actividad</h2>
                                <p class="text-gray-600">No se encontraron detalles de actividad reciente</p>
                            </div>
                            <button wire:click='ocultarHistorial'
                                class="px-6 py-2 mt-4 text-white transition bg-blue-500 rounded-md shadow hover:bg-blue-600">
                                Ver otros historiales
                            </button>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <button onclick="my_modal_3.showModal()" class="mt-3 mb-3 btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Agregar mascota
            </button>
            <div>
                <div wire:poll="mascotas" class="grid w-full grid-cols-2 gap-2 py-5 lg:gap-4 lg:grid-cols-3">
                    @if ($mascotas)
                        @foreach ($mascotas as $index => $pet)
                            <button wire:click='mostraHistorial({{ $pet['id'] }})'
                                class="flex items-center w-full h-32 gap-2 px-5 py-5 border rounded-lg shadow-md cursor-pointer j ustify-start hover:bg-gray-100 hover:text-black">
                                <div class="relative rounded-full">
                                    <p
                                        class="absolute w-6 h-6 rounded-full {{ $pet['estado'] == 'Activo' ? ' bg-green-500 border-green-600' : 'text-red-600 bg-red-500 border-red-600' }}">
                                    </p>
                                    <img src="{{ 'https://api.happypetshco.com/ServidorMascotas/' . $pet['imagen'] }}"
                                        class="object-cover w-20 h-20 rounded-full" alt="">
                                </div>
                                <span class="text-start">
                                    <h2 class="text-lg font-semibold lg:text-md">{{ $pet['nombre'] }}</h2>
                                    <p>{{ $pet['edad'] }}</p>
                                    <p>{{ $pet['especie'] }}</p>
                                </span>
                            </button>
                        @endforeach
                    @endif
                </div>

                <dialog id="my_modal_3" class="py-4 modal" wire:ignore.self>
                    <div class="w-11/12 max-w-4xl py-4 modal-box">
                        <form method="dialog">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Añade tu mascota
                            </h3>
                            <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
                        </form>
                        <div class="grid w-full grid-cols-2 gap-4 mt-3">
                            <div>
                                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 ">Nombre de
                                    mascota</label>
                                <input type="text" name="nombre" id="nombre" wire:model.live='nombre'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Boby" />
                            </div>
                            <div>
                                <label for="edad"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Edad</label>
                                <input type="text" name="edad" id="edad" placeholder="2 meses"
                                    wire:model.live='edad'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-between mt-4">
                            <label for="especie"
                                class="block w-full mb-2 text-sm font-medium text-gray-900 text-start">Seleciona
                                Especie</label>
                            <div class="grid items-center justify-center w-full h-full grid-cols-5 gap-4">
                                @foreach ($especies as $especie)
                                    <button wire:click='actualizarEspecie("{{ $especie }}")'
                                        class="{{ $especieSeleccionada == $especie ? 'ring-4 ring-blue-500' : 'ring-4 ring-transparent' }} flex flex-col items-center justify-center w-full px-2 py-2 border
                                    border-gray-200 rounded-lg cursor-pointer hover:ring-blue-400">
                                        <input type="checkbox" wire:model.live="especieSeleccionada"
                                            value="{{ $especie }}" class="sr-only">
                                        @if ($especie == 'Perro')
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 576 512">
                                                <path
                                                    d="M309.6 158.5L332.7 19.8C334.6 8.4 344.5 0 356.1 0c7.5 0 14.5 3.5 19 9.5L392 32l52.1 0c12.7 0 24.9 5.1 33.9 14.1L496 64l56 0c13.3 0 24 10.7 24 24l0 24c0 44.2-35.8 80-80 80l-32 0-16 0-21.3 0-5.1 30.5-112-64zM416 256.1L416 480c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-115.2c-24 12.3-51.2 19.2-80 19.2s-56-6.9-80-19.2L160 480c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-230.2c-28.8-10.9-51.4-35.3-59.2-66.5L1 167.8c-4.3-17.1 6.1-34.5 23.3-38.8s34.5 6.1 38.8 23.3l3.9 15.5C70.5 182 83.3 192 98 192l30 0 16 0 159.8 0L416 256.1zM464 80a16 16 0 1 0 -32 0 16 16 0 1 0 32 0z" />
                                            </svg>
                                            {{ $especie }}
                                        @elseif($especie == 'Gato')
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 576 512">
                                                <path
                                                    d="M320 192l17.1 0c22.1 38.3 63.5 64 110.9 64c11 0 21.8-1.4 32-4l0 4 0 32 0 192c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-140.8L280 448l56 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-144 0c-53 0-96-43-96-96l0-223.5c0-16.1-12-29.8-28-31.8l-7.9-1c-17.5-2.2-30-18.2-27.8-35.7s18.2-30 35.7-27.8l7.9 1c48 6 84.1 46.8 84.1 95.3l0 85.3c34.4-51.7 93.2-85.8 160-85.8zm160 26.5s0 0 0 0c-10 3.5-20.8 5.5-32 5.5c-28.4 0-54-12.4-71.6-32c0 0 0 0 0 0c-3.7-4.1-7-8.5-9.9-13.2C357.3 164 352 146.6 352 128c0 0 0 0 0 0l0-96 0-20 0-1.3C352 4.8 356.7 .1 362.6 0l.2 0c3.3 0 6.4 1.6 8.4 4.2c0 0 0 0 0 .1L384 21.3l27.2 36.3L416 64l64 0 4.8-6.4L512 21.3 524.8 4.3c0 0 0 0 0-.1c2-2.6 5.1-4.2 8.4-4.2l.2 0C539.3 .1 544 4.8 544 10.7l0 1.3 0 20 0 96c0 17.3-4.6 33.6-12.6 47.6c-11.3 19.8-29.6 35.2-51.4 42.9zM432 128a16 16 0 1 0 -32 0 16 16 0 1 0 32 0zm48 16a16 16 0 1 0 0-32 16 16 0 1 0 0 32z" />
                                            </svg>
                                            {{ $especie }}
                                        @elseif($especie == 'Conejo')
                                            <img src="{{ asset('media/conejo.svg') }}" alt="Conejo svg"
                                                class="object-fill h-7 w-7" style="object-contain; bject-fit: cover;">
                                            {{ $especie }}
                                        @elseif($especie == 'Hámster')
                                            <img src="{{ asset('media/hamster.svg') }}" alt="Conejo svg"
                                                class="object-fill w-6 h-6" style="object-contain; bject-fit: cover;">
                                            {{ $especie }}
                                        @elseif($especie == 'Otro')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6"
                                                viewBox="0 0 640 512">
                                                <path
                                                    d="M181.5 197.1l12.9 6.4c5.9 3 12.4 4.5 19.1 4.5c23.5 0 42.6-19.1 42.6-42.6l0-21.4c0-35.3-28.7-64-64-64l-64 0c-35.3 0-64 28.7-64 64l0 21.4c0 23.5 19.1 42.6 42.6 42.6c6.6 0 13.1-1.5 19.1-4.5l12.9-6.4 8.4-4.2L135.1 185c-4.5-3-7.1-8-7.1-13.3l0-3.7c0-13.3 10.7-24 24-24l16 0c13.3 0 24 10.7 24 24l0 3.7c0 5.3-2.7 10.3-7.1 13.3l-11.8 7.9 8.4 4.2zm-8.6 49.4L160 240l-12.9 6.4c-12.6 6.3-26.5 9.6-40.5 9.6c-3.6 0-7.1-.2-10.6-.6l0 .6c0 35.3 28.7 64 64 64l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l160 0 0-48 0-16c0-23.7 12.9-44.4 32-55.4c9.4-5.4 20.3-8.6 32-8.6l0-16c0-26.5 21.5-48 48-48c8.8 0 16 7.2 16 16l0 32 0 16 0 48c0 8.8 7.2 16 16 16s16-7.2 16-16l0-99.7c0-48.2-30.8-91-76.6-106.3l-8.5-2.8c-8-2.7-12.6-11.1-10.4-19.3s10.3-13.2 18.6-11.6l19.9 4C576 86.1 640 164.2 640 254.9l0 1.1s0 0 0 0c0 123.7-100.3 224-224 224l-1.1 0L256 480l-.6 0C132 480 32 380 32 256.6l0-.6 0-39.2c-10.1-14.6-16-32.3-16-51.4L16 144l0-1.4C6.7 139.3 0 130.5 0 120c0-13.3 10.7-24 24-24l2.8 0C44.8 58.2 83.3 32 128 32l64 0c44.7 0 83.2 26.2 101.2 64l2.8 0c13.3 0 24 10.7 24 24c0 10.5-6.7 19.3-16 22.6l0 1.4 0 21.4c0 1.4 0 2.8-.1 4.3c12-6.2 25.7-9.6 40.1-9.6l8 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-8 0c-13.3 0-24 10.7-24 24l0 8 56.4 0c-15.2 17-24.4 39.4-24.4 64l-32 0c-42.3 0-78.2-27.4-91-65.3c-5.1 .9-10.3 1.3-15.6 1.3c-14.1 0-27.9-3.3-40.5-9.6zM96 128a16 16 0 1 1 0 32 16 16 0 1 1 0-32zm112 16a16 16 0 1 1 32 0 16 16 0 1 1 -32 0z" />
                                            </svg>
                                            {{ $especie }}
                                        @endif
                                    </button>
                                @endforeach
                            </div>
                        </div>
                        @if ($especieSeleccionada == 'Otro')
                            <div class="mt-3">
                                <label for="especie"
                                    class="block mb-2 text-sm font-medium text-gray-900 ">Especifique
                                    especie</label>
                                <input type="text" name="especie" id="especie" placeholder="Raton"
                                    wire:model.live='especiee'
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
                            </div>
                        @endif
                        <div class="mt-3">
                            <label for="raza" class="block mb-2 text-sm font-medium text-gray-900 ">Raza</label>
                            <input type="text" name="edad" id="edad" placeholder="Golden"
                                wire:model.live='raza'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
                        </div>

                        <label for="raza" class="block mt-3 mb-2 text-sm font-medium text-gray-900 ">Seleciona
                            Sexo</label>
                        <div class="flex items-center justify-center gap-10 px-5 mt-1 mb-4">
                            <button wire:click='actualizarSexo("Macho")'
                                class="{{ $sexo == 'Macho' ? 'ring-4 ring-blue-500' : 'ring-4 ring-transparent' }} flex flex-col items-center justify-center px-2 py-2 w-32 border
                                    border-gray-200 rounded-lg cursor-pointer hover:ring-blue-400">
                                <input type="checkbox" wire:model.live="sexo" value="Macho" class="sr-only">
                                Macho
                            </button>
                            <button wire:click='actualizarSexo("Hembra")'
                                class="{{ $sexo == 'Hembra' ? 'ring-4 ring-rosa' : 'ring-4 ring-transparent' }} flex flex-col items-center justify-center px-2 py-2 w-32 border
                                    border-gray-200 rounded-lg cursor-pointer hover:ring-rosa">
                                <input type="checkbox" wire:model.live="sexo" value="Hembra" class="sr-only">
                                Hembra
                            </button>
                        </div>

                        <label for="dropzone-file"
                            class="flex flex-col h-14 {{ $imagen ? 'border-green-600 mt-3 py-4  bg-green-200' : 'border-gray-300 bg-slate-100' }} items-center justify-center w-full h-64 border-2  border-dashed rounded-lg cursor-pointer">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-10 h-10 mb-4 {{ $imagen ? 'text-green-600' : 'text-gray-500' }}"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="mb-2 text-lg {{ $img ? 'text-green-600' : 'text-gray-500' }}""><span
                                        class="font-semibold">Seleciona </span> o arrastra y suelta imagen</p>
                                <p class="text-lg {{ $img ? 'text-green-600' : 'text-gray-500' }}"">SVG, PNG, JPG o
                                    GIF</p>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" wire:model.live="imagen" />
                        </label>


                        <button type="submit" wire:click='addMascota'
                            class="w-full mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Agregar
                            mascota
                        </button>
                    </div>
                </dialog>
            </div>
            <div class="space-y-12">
                <div class="pb-5">

                    <div class="pb-12 border-b border-gray-900/10">
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Información Personal</h2>

                        @if ($permisos && array_intersect($permisos, ['Veterinario', 'Administrador', 'Cajero/Vendedor']))
                            @if ($imagenUser)
                                <div class="items-center justify-center w-full avatar">
                                    <div class="border rounded-full w-60">
                                        <img
                                            src="{{ 'https://api.happypetshco.com/ServidorPerfiles/' . $imagenUser }}" />
                                    </div>
                                </div>
                            @else
                                <div class="items-center justify-center w-full avatar">
                                    <div class="border rounded-full w-60">
                                        <img src="{{ asset('img/profile-user-icon-2048x2048-m41rxkoe.png') }}" />
                                    </div>
                                </div>
                            @endif
                        @endif

                        <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-3">
                                <label for="first-name"
                                    class="block text-sm font-medium leading-6 text-gray-900">Nombres</label>
                                <div class="mt-2">
                                    <input type="text" wire:model.live='nombres' autocomplete="given-name"
                                        value="{{ $nombres }}" disabled
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="telefono"
                                    class="block text-sm font-medium leading-6 text-gray-900">Apellidos</label>
                                <div class="mt-2">
                                    <input type="text" wire:model.live='apellidos' value="{{ $apellidos }}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="telefono"
                                    class="block text-sm font-medium leading-6 text-gray-900">Telefono</label>
                                <div class="mt-2">
                                    <input type="text" wire:model.live='telefono' value="{{ $telefono }}"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="email"
                                    class="block text-sm font-medium leading-6 text-gray-900">DNI</label>
                                <div class="mt-2">
                                    <input id="email" wire:model.live='dni' value="{{ $dni }}" disabled
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>

                            <div class="col-span-3">
                                <label for="street-address"
                                    class="block text-sm font-medium leading-6 text-gray-900">Ubicación</label>
                                <div class="mt-2">
                                    <input type="text" wire:model.live='ubicacion' value="{{ $ubicacion }}"
                                        autocomplete="street-address"
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                            @if ($permisos)
                                @foreach ($permisos as $permiso)
                                    @if ($permiso == 'Veterinario')
                                        <div class="col-span-3">
                                            <label for="street-address"
                                                class="block text-sm font-medium leading-6 text-gray-900">Especialidad</label>
                                            <div class="mt-2">
                                                <input type="text" readonly wire:model.live='especialidad'
                                                    id="street-address" value="{{ $especialidad }}"
                                                    autocomplete="street-address"
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                        </div>

                                        <div class="col-span-3">
                                            <label for="street-address"
                                                class="block text-sm font-medium leading-6 text-gray-900">Descripción</label>
                                            <div class="mt-2 w-full rounded-md border-2 px-2 py-1.5">
                                                {{ $descripcion ?? 'Sin Descripción' }}
                                            </div>
                                        </div>

                                        <div class="col-span-3">
                                            <label for="street-address"
                                                class="block text-sm font-medium leading-6 text-gray-900">Cambiar
                                                Perfil</label>
                                            <div class="mt-2">
                                                <input type="file" wire:model.live='imagenUsuario'
                                                    class="block w-full text-gray-900 border-0 rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                            </div>
                                        </div>

                                        <div class="col-span-full">
                                            <label for="street-address"
                                                class="block text-sm font-medium leading-6 text-gray-900">Añade
                                                Descripcion</label>
                                            <div class="mt-2">
                                                <textarea type="text" placeholder="Descripción corta" wire:model.live='descripcion'
                                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                </textarea>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif


                            <div class="sm:col-span-2">
                                <label for="region"
                                    class="block text-sm font-medium leading-6 text-gray-900">Permisos</label>
                                <div class="mt-2">
                                    <input type="text" name="region" id="region"
                                        autocomplete="address-level1" value="{{ implode(', ', $permisos) }}" disabled
                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex items-center justify-end mt-6 gap-x-6">
                    <button type="button" wire:click='ActualizarDatos'
                        class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <span wire:loading.remove>
                            Guardar cambios
                        </span>
                        <span wire:loading>
                            Cargando...
                        </span>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
<script>
    window.addEventListener('correcto', () => {
        iziToast.success({
            message: event.detail,
            position: 'topRight',
            timeout: 5000,
            progressBar: true,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            theme: 'light',
            transitionIn: 'bounce'
        });
    });

    window.addEventListener('error', () => {
        iziToast.error({
            message: event.detail,
            position: 'topRight',
            timeout: 5000,
            progressBar: true,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            theme: 'light',
            transitionIn: 'bounce'
        });
    });
</script>
