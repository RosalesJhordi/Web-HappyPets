<div class="w-full mx-auto bg-white border rounded-lg shadow-lg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    @if ($detalles)
        @if ($detallesCita)
            <button class="btn btn-primary" wire:click='ocultar'>
                <i class="fa-solid fa-xmark"></i>
            </button>
            {{ $citadetalles['fecha'] }}

            <div class="max-w-4xl p-8 mx-auto rounded-lg shadow-xl bg-gradient-to-r from-blue-50 to-blue-100">
                <div class="items-center justify-center w-full avatar">
                    <div class="h-48 w-44 mask mask-squircle">
                        <img src="{{ 'https://api.happypetshco.com/ServidorMascotas/' . $citadetalles['mascota']['imagen'] }}"
                            alt="Imagen servicio {{ $citadetalles['mascota']['nombre'] }}" class="w-full" />
                    </div>
                </div>
                <!-- Sección de Servicio -->
                <h3 class="flex items-center mt-8 mb-4 space-x-2 text-xl font-semibold text-blue-700">
                    <span>💼</span>
                    <span>Servicio</span>
                </h3>
                <div>
                    <label class="block mb-1 font-medium text-gray-600">Tipo de Servicio:</label>
                    <input type="text"
                        class="w-full px-4 py-2 text-gray-800 bg-gray-100 border rounded-md focus:outline-none"
                        value="{{ $citadetalles['servicio']['tipo'] ?? '' }}" readonly />
                </div>

                <!-- Sección de Mascota -->
                <h3 class="flex items-center mt-8 mb-4 space-x-2 text-xl font-semibold text-blue-700">
                    <span>🐾</span>
                    <span>Mascota</span>
                </h3>
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Nombre:</label>
                        <input type="text"
                            class="w-full px-4 py-2 text-gray-800 bg-gray-100 border rounded-md focus:outline-none"
                            value="{{ $citadetalles['mascota']['nombre'] ?? '' }}" readonly />
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Estado:</label>
                        <input type="text"
                            class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                            value="{{ $citadetalles['mascota']['estado'] ?? '' }}" readonly />
                    </div>
                </div>
                <h2 class="flex items-center mt-8 mb-6 space-x-2 text-3xl font-semibold text-gray-800">
                    <span>🗓️</span>
                    <span>Detalles de Cita de {{ $citadetalles['mascota']['nombre'] }}</span>
                </h2>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Fecha:</label>
                        <input type="text"
                            class="w-full px-4 py-2 text-gray-800 bg-gray-100 border rounded-md focus:outline-none"
                            value="{{ $citadetalles['fecha'] ?? '' }}" readonly />
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Hora:</label>
                        <input type="text"
                            class="w-full px-4 py-2 text-gray-800 bg-gray-100 border rounded-md focus:outline-none"
                            value="{{ $citadetalles['hora'] ?? '' }}" readonly />
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Síntomas:</label>
                        <input type="text"
                            class="w-full px-4 py-2 text-gray-800 bg-gray-100 border rounded-md focus:outline-none"
                            value="{{ $citadetalles['sintomas'] ?? '' }}" readonly />
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Adelanto:</label>
                        <input type="text"
                            class="w-full px-4 py-2 text-gray-800 bg-gray-100 border rounded-md focus:outline-none"
                            value="{{ $citadetalles['adelanto'] ?? '' }}" readonly />
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Estado:</label>
                        <select wire:model.live='estado_cita'
                            class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
                            <option value="Pendiente" {{ $citadetalles['estado'] == 'Pendiente' ? 'selected' : '' }}>
                                Pendiente</option>
                            <option value="Cancelado" {{ $citadetalles['estado'] == 'Cancelado' ? 'selected' : '' }}>
                                Cancelado</option>
                            <option value="Terminado" {{ $citadetalles['estado'] == 'Terminado' ? 'selected' : '' }}>
                                Terminado</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Observaciones:</label>
                        <textarea class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                            wire:model.live='observaciones_cita' placeholder="Escribe tus observaciones aquí">{{ $citadetalles['observaciones'] }}</textarea>
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Importe:</label>
                        <input type="text" wire:model.live='importe_cita'
                            class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                            value="{{ $citadetalles['importe'] ?? '' }}" placeholder="Sin datos" />
                    </div>
                    <div>
                        <label class="block mb-1 font-medium text-gray-600">Próxima Cita:</label>
                        <input type="date" wire:model.live='proxima_cita'
                            class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                            value="{{ $citadetalles['proxima_cita'] ?? '' }}" />
                    </div>

                    <!-- Campos adicionales que se muestran si están en null -->
                    @if (is_null($citadetalles['evaluaciones']))
                        <div>
                            <label class="block mb-1 font-medium text-gray-600">Evaluaciones:</label>
                            <input type="text" wire:model.live='evaluaciones_cita'
                                class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                placeholder="Ingrese evaluaciones" />
                        </div>
                    @endif
                    @if (is_null($citadetalles['consentimiento']))
                        <div>
                            <label class="block mb-1 font-medium text-gray-600">Consentimiento:</label>
                            <input readonly type="text"
                                class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400 "
                                value="{{ $citadetalles['consentimiento'] }}" readonly />
                        </div>
                    @endif
                    @if (is_null($citadetalles['horas_hospedaje']))
                        <div>
                            <label class="block mb-1 font-medium text-gray-600">Horas de Hospedaje:</label>
                            <input type="number" wire:model.live='horas_hospedaje'
                                class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                placeholder="Ingrese horas de hospedaje" />
                        </div>
                    @endif
                    @if (is_null($citadetalles['dias_internado']))
                        <div>
                            <label class="block mb-1 font-medium text-gray-600">Días de Internado:</label>
                            <input type="number" wire:model.live='dias_internado'
                                class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                placeholder="Ingrese días de internado" />
                        </div>
                    @endif
                    @if (is_null($citadetalles['motivo_internado']))
                        <div>
                            <label class="block mb-1 font-medium text-gray-600">Motivo de Internado:</label>
                            <input type="text"
                                class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                placeholder="Ingrese motivo de internado" readonly />
                        </div>
                    @endif
                    @if (is_null($citadetalles['imagenes_lab']))
                        <div>
                            <label class="block mb-1 font-medium text-gray-600">Imágenes de Laboratorio:</label>
                            <input type="file" wire:model.live='imagen'
                                class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                placeholder="Ingrese imágenes de laboratorio" />
                        </div>
                    @endif
                    @if (is_null($citadetalles['tratamiento']))
                        <div>
                            <label class="block mb-1 font-medium text-gray-600">Tratamiento:</label>
                            <input type="text" wire:model.live='tratamiento_cita'
                                class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                placeholder="Ingrese tratamiento" />
                        </div>
                    @endif
                    @if (is_null($citadetalles['resultados']))
                        <div>
                            <label class="block mb-1 font-medium text-gray-600">Resultados:</label>
                            <input type="text" wire:model.live='resultados'
                                class="w-full px-4 py-2 text-gray-800 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                placeholder="Ingrese resultados" />
                        </div>
                    @endif
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-end mt-8 space-x-4">
                    <button
                    wire:click="guardarCambios({{ $citadetalles['id'] }})"
                        class="px-6 py-2 text-white bg-blue-500 rounded-md shadow hover:bg-blue-600">Guardar
                        cambios</button>
                    <button
                        class="px-6 py-2 text-gray-700 bg-gray-300 rounded-md shadow hover:bg-gray-400">Cancelar</button>
                </div>
            </div>
        @else
            <button class="btn btn-primary" wire:click='ocultarDetalles'>
                <i class="fa-solid fa-xmark"></i>
            </button>
            {{ $fech }}
            @if (isset($citas) && count($citas) > 0)
                <div class="grid w-full grid-cols-2 gap-6 p-6 xl:grid-cols-4 md:grid-cols-3">
                    @foreach ($citas as $cita)
                        <div
                            class="p-6 transition-all duration-300 transform bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-xl hover:scale-105 hover:translate-y-2 ">
                            <!-- Tipo de servicio -->
                            <div class="flex items-center justify-between mb-4">
                                <h5 class="text-xl font-semibold text-gray-900 ">
                                    {{ $cita['servicio']['tipo'] }} - {{ $cita['hora'] }}
                                </h5>
                                <span
                                    class="px-4 py-2 text-xs font-semibold rounded-full {{ $cita['estado'] === 'Terminado' ? 'bg-indigo-200 text-indigo-800' : 'bg-green-200 text-green-800' }}">
                                    {{ $cita['estado'] }}
                                </span>
                            </div>

                            <!-- Detalles breves -->
                            <div class="pb-4 mb-4 border-b-2">
                                <div class="relative w-full h-48 mt-3 mb-4">
                                    <img src="{{ 'https://api.happypetshco.com/ServidorMascotas/' . $cita['mascota']['imagen'] }}"
                                        alt="Imagen mascota {{ $cita['mascota']['nombre'] }}"
                                        class="object-cover w-full h-full rounded-lg shadow-md">
                                </div>
                                <p class="text-gray-700 ">
                                    <span class="font-semibold text-gray-900 ">Mascota:</span>
                                    {{ $cita['mascota']['nombre'] }}
                                    <span class="text-gray-500 ">({{ $cita['mascota']['especie'] }},
                                        {{ $cita['mascota']['edad'] }}, {{ $cita['mascota']['raza'] }})</span>
                                </p>
                                <p class="mt-2 text-gray-700 ">
                                    Estado: <span
                                        class="italic text-gray-900 ">{{ $cita['estado'] }}</span>.
                                </p>
                            </div>

                            <!-- Botón para ver detalles -->
                            <button type="button" wire:click='detallescita({{ $cita['id'] }})'
                                class="inline-flex items-center px-6 py-3 text-sm font-medium text-white transition-all duration-200 bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 hover:shadow-lg">
                                Ver detalles
                                <svg class="w-5 h-5 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="flex flex-col items-center justify-center p-6 bg-gray-100 rounded-lg shadow-md ">
                    <!-- Imagen de estado vacío -->
                    <img src="data:image/png;base64,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"
                        alt="No hay citas" class="object-cover w-32 h-32 mb-4">

                    <!-- Mensaje cuando no hay citas -->
                    <p class="text-xl font-semibold text-gray-800 ">
                        No hay citas hoy
                    </p>
                    <p class="mt-2 text-center text-gray-500 ">
                        No se han programado citas para el día de hoy. Por favor, vuelve más tarde.
                    </p>
                </div>
            @endif
        @endif
    @else
        <div class="flex items-center justify-between px-4 py-3 mb-4 rounded-t-lg shadow">
            <!-- Botones para cambiar mes -->
            <div class="flex items-center space-x-2">
                <h2 class="text-xl font-semibold">
                    {{ now()->day }}
                    {{ \Carbon\Carbon::create($currentYear, $currentMonth)->locale('es')->monthName }}
                    {{ $currentYear }}
                </h2>
            </div>
        </div>

        <div class="grid grid-cols-7 overflow-hidden font-semibold text-center text-white bg-gray-200 shadow">
            <div class="py-2 bg-indigo-500">Dom</div>
            <div class="py-2 bg-indigo-500">Lun</div>
            <div class="py-2 bg-indigo-500">Mar</div>
            <div class="py-2 bg-indigo-500">Mie</div>
            <div class="py-2 bg-indigo-500">Jue</div>
            <div class="py-2 bg-indigo-500">Vie</div>
            <div class="py-2 bg-indigo-500">Sab</div>
        </div>

        <div class="grid grid-cols-7 gap-2 p-2 mt-2 rounded-b-lg shadow-inner bg-gray-50">
            @for ($i = 0; $i < $primerDiaDelMes; $i++)
                <div></div>
            @endfor

            @for ($dia = 1; $dia <= $diasDelMes; $dia++)
                <div wire:click="diaa({{ $dia }}, {{ $currentMonth }}, {{ $currentYear }})"
                    class="relative p-2 border rounded-lg h-32 overflow-y-auto scrollbar-hidden
                {{ $dia == $diaActual ? 'bg-blue-100 font-semibold hover:bg-blue-100' : 'bg-white text-gray-900' }}
                hover:bg-blue-100 cursor-pointer transition duration-300 ease-in-out">

                    <span class="sticky top-0 text-xl font-bold">{{ $dia }}</span>

                    @foreach ($eventos as $evento)
                        @php
                            $fechaEvento = \Carbon\Carbon::createFromFormat('d/m/Y', $evento['fecha']);
                        @endphp

                        @if ($fechaEvento->day == $dia && $fechaEvento->month == $currentMonth && $fechaEvento->year == $currentYear)
                        <div class="w-full">
                            <span
                                class="inline-flex items-center px-2 py-1 mt-2 text-xs font-medium rounded-md ring-1 ring-inset
                                {{ $evento['estado'] == 'Terminado' ? 'text-red-700 bg-red-50 ring-red-600/10' :
                                   ($evento['estado'] == 'Cancelado' ? 'text-gray-500 bg-gray-100 ring-gray-400/10' :
                                   'text-emerald-700 bg-emerald-50 ring-emerald-600/10') }}">
                                <span class="px-2">
                                    <i class="fa-solid fa-shield-dog"></i>
                                </span>
                                {{ $evento['servicio']['tipo'] }} - {{ $evento['estado'] }} - {{ $evento['hora'] }}
                            </span>
                        </div>
                        @endif
                    @endforeach

                </div>
            @endfor

        </div>

        <div class="grid w-1/4 grid-cols-2 px-2 py-2 join">
            <button wire:click="mesAnterior" class="join-item btn btn-outline">Mes Anterior</button>
            <button wire:click="mesSiguiente" class="join-item btn btn-outline">Próximo mes</button>
        </div>
    @endif
</div>
<script>
    window.addEventListener('correcto', () => {
        console.log("fdsd");

        iziToast.success({
            message: event.detail,
            position: 'topRight',
            timeout: 5000,
            progressBar: true,
            closeOnClick: true,
            pauseOnHover: true,
            draggable: true,
            theme: 'light',
            transitionIn: 'bounce',
            zindex: 999999
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
            transitionIn: 'bounce',
            zindex: 999999
        });
    });
</script>
