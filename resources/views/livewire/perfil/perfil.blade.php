<div class="w-full bg-white">
    <div class="max-w-xl px-4 py-5 mx-auto sm:px-6 sm:py-10 lg:max-w-5xl lg:px-8">
        <h2 class="text-lg font-bold tracking-tight text-gray-500 lg:text-2xl">Hola: {{ $nombres }}</h2>
        <button onclick="my_modal_3.showModal()" class="mt-3 mb-3 btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Agregar mascota
        </button>
        <div>
            <div wire:poll="mascotas" class="grid w-full grid-cols-2 gap-2 py-5 lg:gap-4 lg:grid-cols-3">
                @foreach ($mascotas as $index => $pet)
                    <div
                        class="flex items-center justify-start w-full h-32 gap-2 px-5 py-5 text-gray-400 bg-white border rounded-sm shadow-md cursor-pointer hover:bg-gray-100 hover:text-black">
                        <img src="{{ 'https://api-happypetshco-com.preview-domain.com/ServidorMascotas/' . $pet['imagen'] }}"
                            class="object-cover w-20 h-20 rounded-full" alt="">
                        <span>
                            <h2 class="text-lg font-semibold lg:text-md">{{ $pet['nombre'] }}</h2>
                            <p>{{ $pet['edad'] }}</p>
                        </span>
                    </div>
                @endforeach
            </div>

            <dialog id="my_modal_3" class="py-4 modal" wire:ignore.self>
                <div class="w-11/12 max-w-4xl py-4 modal-box">
                    <form method="dialog">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Añade tu mascota
                        </h3>
                        <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
                    </form>
                    <div class="grid w-full grid-cols-2 gap-4 mt-3">
                        <div>
                            <label for="nombre"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre de
                                mascota</label>
                            <input type="text" name="nombre" id="nombre" wire:model.live='nombre'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Boby" />
                        </div>
                        <div>
                            <label for="edad"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad</label>
                            <input type="text" name="edad" id="edad" placeholder="2 meses"
                                wire:model.live='edad'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-between mt-4">
                        <label for="especie"
                            class="block w-full mb-2 text-sm font-medium text-gray-900 dark:text-white text-start">Seleciona
                            Especie</label>
                        <div class="grid items-center justify-center w-full h-full grid-cols-5 gap-4">
                            @foreach ($especies as $especie)
                                <button wire:click='actualizarEspecie("{{ $especie }}")'
                                    class="{{ $especieSeleccionada == $especie ? 'ring-4 ring-blue-500' : 'ring-4 ring-transparent' }} flex flex-col items-center justify-center w-full px-2 py-2 border
                                    border-gray-200 rounded-lg cursor-pointer hover:ring-blue-400">
                                    <input type="checkbox" wire:model.live="especieSeleccionada"
                                        value="{{ $especie }}" class="sr-only">
                                    @if ($especie == 'Perro')
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                            <path
                                                d="M309.6 158.5L332.7 19.8C334.6 8.4 344.5 0 356.1 0c7.5 0 14.5 3.5 19 9.5L392 32l52.1 0c12.7 0 24.9 5.1 33.9 14.1L496 64l56 0c13.3 0 24 10.7 24 24l0 24c0 44.2-35.8 80-80 80l-32 0-16 0-21.3 0-5.1 30.5-112-64zM416 256.1L416 480c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-115.2c-24 12.3-51.2 19.2-80 19.2s-56-6.9-80-19.2L160 480c0 17.7-14.3 32-32 32l-32 0c-17.7 0-32-14.3-32-32l0-230.2c-28.8-10.9-51.4-35.3-59.2-66.5L1 167.8c-4.3-17.1 6.1-34.5 23.3-38.8s34.5 6.1 38.8 23.3l3.9 15.5C70.5 182 83.3 192 98 192l30 0 16 0 159.8 0L416 256.1zM464 80a16 16 0 1 0 -32 0 16 16 0 1 0 32 0z" />
                                        </svg>
                                        {{ $especie }}
                                    @elseif($especie == 'Gato')
                                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 640 512">
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
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Especifique
                                especie</label>
                            <input type="text" name="especie" id="especie" placeholder="Raton"
                                wire:model.live='especiee'
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
                        </div>
                    @endif
                    <div class="mt-3">
                        <label for="raza"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Raza</label>
                        <input type="text" name="edad" id="edad" placeholder="Golden" wire:model.live='raza'
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
                    </div>

                    <label for="raza"
                        class="block mt-3 mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleciona Sexo</label>
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
                        class="w-full mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Agregar
                        mascota
                    </button>
                </div>
            </dialog>
        </div>
        <div class="space-y-12">
            <div class="pb-5">

                <div class="pb-12 border-b border-gray-900/10">
                    <h2 class="text-base font-semibold leading-7 text-gray-900">Información Personal</h2>

                    <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="first-name"
                                class="block text-sm font-medium leading-6 text-gray-900">Nombres</label>
                            <div class="mt-2">
                                <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                    value="{{ $nombres }}" disabled
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="telefono"
                                class="block text-sm font-medium leading-6 text-gray-900">Telefono</label>
                            <div class="mt-2">
                                <input type="text" name="telefono" id="telefono" autocomplete="family-name"
                                    value="{{ $telefono }}"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="email"
                                class="block text-sm font-medium leading-6 text-gray-900">DNI</label>
                            <div class="mt-2">
                                <input id="email" name="email" type="email" autocomplete="email"
                                    value="{{ $dni }}" disabled
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="street-address"
                                class="block text-sm font-medium leading-6 text-gray-900">Ubicación</label>
                            <div class="mt-2">
                                <input type="text" name="street-address" id="street-address"
                                    value="{{ $ubicacion }}" autocomplete="street-address"
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>



                        <div class="sm:col-span-2">
                            <label for="region"
                                class="block text-sm font-medium leading-6 text-gray-900">Permisos</label>
                            <div class="mt-2">
                                <input type="text" name="region" id="region" autocomplete="address-level1"
                                    value="{{ implode(', ', $permisos) }}" disabled
                                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="flex items-center justify-end mt-6 gap-x-6">
                <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                <button type="submit"
                    class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
            </div>
        </div>
    </div>
</div>
