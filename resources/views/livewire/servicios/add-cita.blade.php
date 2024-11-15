<div class="w-11/12 max-w-5xl modal-box">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <form method="dialog">
        <button id="closeButton" class="absolute z-50 border-none btn btn-lg btn-ghost right-1 top-1">
            ✕
        </button>
    </form>
    <h1>Reservar nueva cita</h1>
    <ul class="w-full mt-4 mb-3 steps">
        <li class="step animated-step @if ($step >= 0) step-primary @endif">Elige Mascota</li>
        <li class="step animated-step @if ($step >= 1) step-primary @endif">Elige Día</li>
        <li class="step animated-step @if ($step >= 2) step-primary @endif" id="step2">Elige Hora
        </li>
        <li class="step animated-step @if ($step == 3) step-primary @endif" id="step3">Confirmar
            cita</li>
    </ul>

    @if ($step <= 0)
        <div>
            @if ($mascotas)
                <div
                    class="grid grid-cols-2 gap-4 p-4 mt-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($mascotas as $mascota)
                        <button wire:click='actualizarMascota("{{ $mascota['id'] }}")'
                            class="{{ $id_mascota == $mascota['id'] ? 'ring-4 ring-blue-500' : 'ring-4 ring-transparent' }} flex flex-col items-center justify-center w-full h-44 p-1 border
                        border-gray-200 rounded-lg cursor-pointer hover:ring-blue-400 hover:shadow-xl transition transform hover:scale-105 space-y-3 shadow-md">

                            <div
                                class="relative w-24 h-24 overflow-hidden border-4 {{ $mascota['estado'] == 'Activo' ? 'border-green-300' : 'border-red-300' }} rounded-full">
                                <img src="https://api.happypetshco.com/ServidorMascotas/{{ $mascota['imagen'] }}"
                                    alt="Imagen de {{ $mascota['nombre'] }}" class="object-cover w-full h-full">
                            </div>

                            <span class="mt-2 text-lg font-semibold text-center text-gray-800">
                                {{ $mascota['nombre'] }}
                            </span>

                            <div class="flex space-x-2">
                                <span class="px-2 py-1 text-xs font-medium text-white bg-green-500 rounded-full">
                                    {{ $mascota['especie'] }}
                                </span>
                                <span class="px-2 py-1 text-xs font-medium text-white bg-purple-500 rounded-full">
                                    {{ $mascota['raza'] }}
                                </span>
                            </div>
                        </button>
                    @endforeach
                    <button onclick="document.getElementById('my_modall_30').showModal()"
                        class="font-semibold h-44 btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Agregar mascota
                    </button>
                </div>
            @endif
        </div>
    @endif
    <form novalidate>
        <div id="paso1" style="@if ($step != 1) display: none; @endif">
            <h1 class="py-2 font-semibold uppercase text-graay-400">Elige el día</h1>
            <div class="w-full px-2 py-2 border">
                <!-- Encabezado del calendario -->
                <div class="flex items-center justify-between mb-4">
                    <button type="button" wire:click="goToPreviousWeek"
                        class="font-bold btn btn-primarytext-xl">&lt;</button>
                    <h2 class="text-2xl font-semibold">
                        Calendario Semanal
                    </h2>
                    <button type="button" wire:click="goToNextWeek"
                        class="font-bold btn btn-primarytext-xl">&gt;</button>
                </div>

                <!-- Días de la semana -->
                <div class="grid grid-cols-7 gap-4 font-medium text-center text-gray-500">
                    <div>Lun</div>
                    <div>Mar</div>
                    <div>Mié</div>
                    <div>Jue</div>
                    <div>Vie</div>
                    <div>Sáb</div>
                    <div>Dom</div>
                </div>

                <!-- Días del mes -->
                <div class="grid grid-cols-7 gap-4 px-2 py-2 mt-2 text-center">
                    @foreach ($daysInWeek as $day)
                        <div class="p-3 rounded-md text-center transition duration-200 ease-in-out
                    {{ $day->isToday()
                        ? 'bg-blue-500 text-white font-semibold cursor-pointer hover:bg-blue-600'
                        : ($dia === $day->format('Y-m-d')
                            ? 'bg-green-100 border border-green-600 text-green-600 font-semibold cursor-pointer hover:bg-green-200'
                            : ($day->isPast()
                                ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
                                : 'bg-gray-100 text-gray-600 cursor-pointer hover:bg-gray-200 hover:text-gray-800')) }}"
                            {{ !$day->isPast() || $day->isToday() ? "wire:click=selectDay('{$day->format('Y-m-d')}')" : '' }}>
                            {{ $day->format('d') }}
                        </div>
                    @endforeach
                </div>
                @if ($dia)
                    <div class="p-4 font-semibold text-green-600 bg-green-100 border border-green-600 rounded-lg">
                        <h3 class="text-lg font-semibold">Día Seleccionado:</h3>
                        <p>{{ \Carbon\Carbon::parse($dia)->format('d M Y') }}</p>
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-between py-2">
                <span></span>
                <input type="text" class="hidden border" wire:model.live="dia">
            </div>
        </div>
        {{-- horas --}}
        <div id="paso2" style="@if ($step != 2) display: none; @endif">
            <h1 class="py-2 font-semibold uppercase text-graay-400">Elige la hora</h1>

            <div class="grid grid-cols-4 gap-4 px-2 py-2 text-center border">
                @forelse($availableHours as $hour)
                <div class="p-2 border rounded-lg cursor-pointer transition duration-200 ease-in-out
                {{ $hora === $hour ? 'text-orange-600 border border-orange-600 bg-orange-100' : 'bg-gray-100' }}
                hover:bg-orange-200" wire:click="selectHour('{{ $hour }}')">
                        {{ $hour }}
                    </div>
                @empty
                    <p class="text-gray-500">No hay horas disponibles para este día.</p>
                @endforelse

            </div>
            <!-- Mostrar la hora seleccionada -->
            @if ($hora)
                <div class="p-4 mt-2 font-semibold text-orange-600 bg-orange-100 border border-orange-600 rounded-lg">
                    <h3 class="text-lg font-semibold">Hora Seleccionada:</h3>
                    <p>{{ $hora }}</p>
                </div>
            @endif

            <input type="text" class="hidden border" wire:model.live="hora">

        </div>

        <div id="paso3" style="@if ($step != 3) display: none; @endif" class="gap-2">
            <h1 class="py-2 font-semibold uppercase text-graay-400">Confirma los datos</h1>
            @if ($dia && $hora)
                <div>
                    @forelse ($mascota as $mascot)
                        <div class="flex items-center px-2 py-2 space-x-4 border rounded-md">
                            <div class="text-lg font-semibold text-gray-800">{{ $mascot['nombre'] }}</div>
                            <span
                                class="px-2 py-1 text-xs font-medium text-white bg-blue-600 rounded-full">{{ $mascot['especie'] }}</span>
                            <span
                                class="px-2 py-1 text-xs font-medium text-white bg-green-500 rounded-full">{{ $mascot['raza'] }}</span>
                        </div>
                    @empty
                    @endforelse

                </div>
                <div class="grid grid-cols-2 gap-4 py-2">

                    <div class="p-4 font-semibold text-green-600 bg-green-100 border border-green-600 rounded-lg">
                        <h3 class="text-lg font-semibold">Día Seleccionado:</h3>
                        <p>{{ \Carbon\Carbon::parse($dia)->format('d M Y') }}</p>
                    </div>
                    <div class="p-4 font-semibold text-orange-600 bg-orange-100 border border-orange-600 rounded-lg">
                        <h3 class="text-lg font-semibold">Hora Seleccionada:</h3>
                        <p>{{ $hora }}</p>
                    </div>

                </div>
            @endif
            {{-- <h2 class="flex items-center justify-center gap-2 px-1 py-4 text-xl border rounded-md">
                <i class="p-2 text-5xl text-yellow-500 fa-solid fa-triangle-exclamation"></i>
                Para poder reservar una cita, es necesario realizar un pago del 20% del costo total del servicio como adelanto, para asegurarnos de que la reserva se hará de manera seria y comprometida.
            </h2> --}}
            <!-- Título con Badge de Advertencia -->
            <div class="mb-6 text-center">
                <h1 class="text-xl font-semibold text-gray-700">Elije método de pago
                    <span class="px-2 py-1 ml-2 text-xs font-medium text-white bg-yellow-500 rounded-full">Estamos
                        Trabajando</span>
                </h1>
            </div>

            <!-- Opciones de Métodos de Pago -->
            <div class="flex items-center justify-center w-full gap-4">
                <!-- Opción de Pago 1 -->
                <div wire:click="seleccionarMetodo('efectivo')"
                    class="flex flex-col items-center justify-center w-1/3 p-4 transition transform border rounded-lg h-52 cursor-pointer {{ $metodoSeleccionado == 'efectivo' ? 'border-blue-600 shadow-lg scale-105' : 'hover:border-blue-600 hover:shadow-lg hover:scale-105' }} bg-gray-50">
                    <img src="{{ asset('img/efectivo.jpg') }}" alt="Logo" class="object-cover w-16 h-16 mb-3">
                    <span class="text-sm font-semibold text-gray-600">Pago con Efectivo</span>
                    <span
                        class="px-2 py-1 mt-2 text-xs font-medium text-white bg-green-500 rounded-full">Recomendado</span>
                </div>

                <!-- Opción de Pago 2 -->
                <div wire:click="seleccionarMetodo('yape')"
                    class="flex flex-col items-center justify-center w-1/3 p-4 transition transform border rounded-lg h-52 cursor-pointer {{ $metodoSeleccionado == 'yape' ? 'border-blue-600 shadow-lg scale-105' : 'hover:border-blue-600 hover:shadow-lg hover:scale-105' }} bg-gray-50">
                    <img src="{{ asset('img/logo (1).png') }}" alt="Logo" class="object-cover w-16 h-16 mb-3">
                    <span class="text-sm font-semibold text-gray-600">Pago con Yape</span>
                    <span
                        class="px-2 py-1 mt-2 text-xs font-medium text-white bg-indigo-600 rounded-full">Próximamente</span>
                </div>

                <!-- Opción de Pago 3 -->
                <div wire:click="seleccionarMetodo('tarjeta')"
                    class="flex flex-col items-center justify-center w-1/3 p-4 transition transform border rounded-lg h-52 cursor-pointer {{ $metodoSeleccionado == 'tarjeta' ? 'border-blue-600 shadow-lg scale-105' : 'hover:border-blue-600 hover:shadow-lg hover:scale-105' }} bg-gray-50">
                    <img src="{{ asset('img/targeta.jpg') }}" alt="Tarjeta" class="object-cover w-16 h-16 mb-3">
                    <span class="text-sm font-semibold text-gray-600">Pago con Tarjeta</span>
                    <span
                        class="px-2 py-1 mt-2 text-xs font-medium text-white bg-indigo-500 rounded-full">Próximamente</span>
                </div>
            </div>


        </div>
    </form>
    <dialog id="my_modall_30" class="py-4 modal" wire:ignore.self>
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
                    <label for="edad" class="block mb-2 text-sm font-medium text-gray-900 ">Edad</label>
                    <input type="text" name="edad" id="edad" placeholder="2 meses"
                        wire:model.live='edad'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
                </div>
            </div>
            <div class="flex flex-col items-center justify-between mt-4">
                <label for="especie" class="block w-full mb-2 text-sm font-medium text-gray-900 text-start">Seleciona
                    Especie</label>
                <div class="grid items-center justify-center w-full h-full grid-cols-5 gap-4">
                    @foreach ($especies as $especie)
                        <button wire:click='actualizarEspecie("{{ $especie }}")'
                            class="{{ $especieSeleccionada == $especie ? 'ring-4 ring-blue-500' : 'ring-4 ring-transparent' }} flex flex-col items-center justify-center w-full px-2 py-2 border
                                border-gray-200 rounded-lg cursor-pointer hover:ring-blue-400">
                            <input type="checkbox" wire:model.live="especieSeleccionada" value="{{ $especie }}"
                                class="sr-only">
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
                    <label for="especie" class="block mb-2 text-sm font-medium text-gray-900 ">Especifique
                        especie</label>
                    <input type="text" name="especie" id="especie" placeholder="Raton"
                        wire:model.live='especiee'
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
                </div>
            @endif
            <div class="mt-3">
                <label for="raza" class="block mb-2 text-sm font-medium text-gray-900 ">Raza</label>
                <input type="text" name="edad" id="edad" placeholder="Golden" wire:model.live='raza'
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
                class="flex flex-col h-8 {{ $imagen ? 'border-green-600 mt-3 mb-3 py-2  bg-green-200' : 'border-gray-300 bg-slate-100' }} items-center justify-center w-full h-64 border-2  border-dashed rounded-lg cursor-pointer">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 {{ $imagen ? 'text-green-600' : 'text-gray-500' }}" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-lg {{ $img ? 'text-green-600' : 'text-gray-500' }}""><span
                            class="font-semibold">Seleciona </span> una imagen</p>
                    <p class="text-lg {{ $img ? 'text-green-600' : 'text-gray-500' }}"">SVG, PNG, JPG o
                        GIF</p>
                </div>
                <input id="dropzone-file" type="file" class="hidden" wire:model.live="imagen" />
            </label>

            <div class="flex items-center justify-center mb-4">
                @if (Session::get('authToken'))
                    <button type="submit" wire:click='addMascota'
                        class="w-full mt-3 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Agregar
                        mascota
                    </button>
                @else
                    <a href="{{ route('Registro') }}"
                        class="w-full mt-8 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Agregar
                        mascota
                    </a>
                @endif
            </div>
        </div>
    </dialog>
    <div class="flex items-center justify-end gap-2 py-2">
        @if ($step <= 0)
            <button type="button" class="btn btn-primary" wire:click="previousStep" disabled>Anterior</button>
        @else
            <button type="button" class="btn btn-primary" wire:click="previousStep">Anterior</button>
        @endif
        @if ($step >= 3)
            <button type="button" class="btn btn-primary" wire:click="reservarCita">Confirmar</button>
        @else
            @if ($id_mascota)
                <button type="button" class="btn btn-primary" wire:click="nextStep">Siguiente</button>
            @else
                <button type="button" class="btn btn-primary" wire:click="nextStep" disabled>Siguiente</button>
            @endif
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

    window.addEventListener('modal', event => {
        const modalId = event.detail;
        const modal = document.getElementById("my_modall_" + modalId);

        if (modal) {
            console.log("cerrado");
            modal.close();
        } else {
            console.log(modal);
        }
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
