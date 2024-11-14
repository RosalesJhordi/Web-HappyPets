<div class="w-11/12 max-w-5xl modal-box">
    <form method="dialog">
        <button id="closeButton" class="absolute z-50 border-none btn btn-lg btn-circle btn-ghost right-1 top-1">
            ✕
        </button>
    </form>
    <h1>Reservar nueva cita</h1>
    <ul class="w-full mt-4 steps">
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
            <div class="grid grid-cols-1 gap-4 p-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($mascotas as $mascota)
                <div class="relative flex items-center max-w-lg overflow-hidden transition-transform transform border border-gray-300 rounded-lg shadow-lg cursor-pointer bg-gradient-to-r from-blue-100 via-purple-100 to-pink-100 hover:scale-105 hover:shadow-xl">
                    <!-- Radio button para selección única -->
                    <input type="radio" name="mascota" id="mascota{{ $mascota['id'] }}" class="absolute opacity-0 peer" />

                    <label for="mascota{{ $mascota['id'] }}" class="flex w-full h-full border-4 border-transparent rounded-lg peer-checked:border-blue-600 peer-checked:bg-blue-50">
                        <!-- Imagen de la mascota -->
                        <div class="w-1/2 avatar">
                            <img src="https://api.happypetshco.com/ServidorMascotas/{{ $mascota['imagen'] }}" alt="Imagen de {{ $mascota['nombre'] }}" class="object-cover w-full h-full rounded-l-lg">
                        </div>

                        <!-- Información de la mascota -->
                        <div class="w-1/2 p-4">
                            <h2 class="mb-2 text-xl font-semibold text-gray-800">{{ $mascota['nombre'] }}</h2>
                            <p class="mb-1 text-gray-600"><span class="font-bold">Raza:</span> {{ $mascota['raza'] }}</p>
                            <p class="text-gray-600"><span class="font-bold">Sexo:</span> {{ $mascota['sexo'] }}</p>
                        </div>
                    </label>

                    <!-- Icono de selección -->
                    <div class="absolute transition-opacity opacity-0 top-2 right-2 peer-checked:opacity-100">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    @endif

    <div class="flex items-center justify-end gap-2 py-2">
        @if ($step <= 0)
            <button type="button" class="btn btn-primary" wire:click="previousStep" disabled>Anterior</button>
        @else<button type="button" class="btn btn-primary" wire:click="previousStep">Anterior</button>
        @endif
        @if ($step >= 3)
            <button type="button" class="btn btn-primary" wire:click="nextStep">Confirmar</button>
        @else
            <button type="button" class="btn btn-primary" wire:click="nextStep">Siguiente</button>
        @endif
    </div>
</div>
