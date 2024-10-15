<div class="w-full px-6 py-2">

    @if ($mostrar)
        <form wire:submit.prevent="registro" novalidate class="flex flex-col w-full gap-4">
            @isset($exito)
                <p class="p-1 mt-2 font-semibold text-center text-green-600 bg-green-300 rounded-sm">{{ $exito['mensaje'] }}
                </p>
            @endisset
            {{-- dni --}}

            <div
                class="flex w-full border rounded-md border-morado-claro focus-within:ring-1 focus-within:ring-morado-claro">
                <span
                    class="inline-flex items-center px-3 text-lg text-white border border-gray-300 bg-morado-claro border-e-0 rounded-s-md ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        strokeWidth={1.5} stroke="currentColor" className="size-6">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                    </svg>

                </span>
                <input wire:model.debounce.500ms="dni" id="dni" type="text" id="website-admin"
                    class="rounded-none rounded-e-lg bg-gray-50 border outline-none focus:ring-blue-500 dar00osa focus:ring-bl-blue-500 block flex-1 min-w-0 w-full text-lg p-2.5 "
                    placeholder="Ingresa su DNI" value="{{ old('dni') }}">
            </div>

            @isset($error)
                @if (isset($error['error']['dni']))
                    <p class="p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">
                        {{ $error['error']['dni'][0] }}
                    </p>
                @endif
            @endisset

            {{-- telefono --}}

            <div class="flex border rounded-md border-morado-claro focus-within:ring-1 focus-within:ring-morado-claro">
                <span
                    class="inline-flex items-center px-3 text-lg text-white border border-gray-300 bg-morado-claro border-e-0 rounded-s-md ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                </span>
                <input wire:model.debounce.500ms="telefono" value="{{ old('telefono') }}" type="text"
                    id="website-admin"
                    class="rounded-none rounded-e-lg bg-gray-50 border outline-none focus:ring-blue-500 dar00osa focus:ring-bl-blue-500 block flex-1 min-w-0 w-full text-lg p-2.5 "
                    placeholder="Ingresa su Telefono">
            </div>

            @isset($error)
                @if (isset($error['error']['telefono']))
                    <p class="p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">
                        {{ $error['error']['telefono'][0] }}
                    </p>
                @endif
            @endisset
            {{-- contraseña --}}

            <div class="flex border rounded-md border-morado-claro focus-within:ring-1 focus-within:ring-morado-claro">
                <span
                    class="inline-flex items-center px-3 text-lg text-white border border-gray-300 bg-morado-claro border-e-0 rounded-s-md ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </span>
                <input wire:model.debounce.500ms="password" type="password" id="website-admin"
                    class="rounded-none rounded-e-lg bg-gray-50 border outline-none focus:ring-blue-500 dar00osa focus:ring-bl-blue-500 block flex-1 min-w-0 w-full text-lg p-2.5 "
                    placeholder="Ingresa su contraseña">
            </div>


            @isset($error)
                @if (isset($error['error']['password']))
                    <p class="p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">
                        {{ $error['error']['password'][0] }}
                    </p>
                @endif
            @endisset

            {{-- confirmacion de contraseña --}}

            <div class="flex border rounded-md border-morado-claro focus-within:ring-1 focus-within:ring-morado-claro">
                <span
                    class="inline-flex items-center px-3 text-lg text-white border border-gray-300 bg-morado-claro border-e-0 rounded-s-md ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>

                </span>
                <input wire:model.debounce.500ms="password_confirmation" type="text" id="website-admin"
                    class="rounded-none rounded-e-lg bg-gray-50 border outline-none focus:ring-blue-500 dar00osa focus:ring-bl-blue-500 block flex-1 min-w-0 w-full text-lg p-2.5 "
                    placeholder="Confima su contraseña">
            </div>

            {{-- boton --}}

            <button type="submit" class="w-full p-3 mt-5 text-white rounded bg-rose-500 btn hover:bg-rosa">Registro</button>
            <div class="divider">O</div>
            <p class="w-full mt-5 text-center">Ya tienes una cuenta?
                <button type="button" wire:click="mostrardiv2" class="font-semibold text-blue-700">Ingresar</button>
            </p>
        </form>
    @else
        <form wire:submit.prevent="login" novalidate class="flex flex-col gap-4">

            @isset($exito)
                <p class="p-1 mt-2 font-semibold text-center text-green-600 bg-green-300 rounded-sm">{{ $exito['mensaje'] }}
                </p>
            @endisset

            {{-- DNI --}}
            <div
                class="flex w-full border rounded-md border-morado-claro focus-within:ring-1 focus-within:ring-morado-claro">
                <span
                    class="inline-flex items-center px-3 text-lg text-white border border-gray-300 bg-morado-claro border-e-0 rounded-s-md ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                        strokeWidth={1.5} stroke="currentColor" className="size-6">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                    </svg>

                </span>
                <input wire:model.debounce.500ms="dni2" id="dni2" type="text" id="website-admin"
                    class="rounded-none rounded-e-lg bg-gray-50 border outline-none focus:ring-blue-500 dar00osa focus:ring-bl-blue-500 block flex-1 min-w-0 w-full text-lg p-2.5 "
                    placeholder="Ingresa su DNI" value="{{ old('dni2') }}">
            </div>

            @isset($error['error']['dni'])
                <p class="p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">
                    {{ $error['error']['dni2'][0] }}</p>
            @endisset

            {{-- Contraseña --}}
            <div class="flex border rounded-md border-morado-claro focus-within:ring-1 focus-within:ring-morado-claro">
                <span
                    class="inline-flex items-center px-3 text-lg text-white border border-gray-300 bg-morado-claro border-e-0 rounded-s-md ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </span>
                <input wire:model.debounce.500ms="password" type="text" id="website-admin"
                    class="rounded-none rounded-e-lg bg-gray-50 border outline-none focus:ring-blue-500 dar00osa focus:ring-bl-blue-500 block flex-1 min-w-0 w-full text-lg p-2.5 "
                    placeholder="Ingresa su contraseña">
            </div>

            @isset($error['error']['password'])
                <p class="p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">
                    {{ $error['error']['password'][0] }}</p>
            @endisset

            {{-- Botón de login --}}
            <button type="submit" class="w-full p-3 mt-5 text-white rounded bg-rose-400 hover:bg-rosa">Login</button>

            <div class="divider">O</div>
            <p class="w-full mt-5 text-center">No tienes una cuenta?
                <button type="button" wire:click="mostrardiv1"
                    class="font-semibold text-blue-700">Registrate</button>
            </p>
        </form>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let dniInput = document.getElementById('dni');
            let dniInputt = document.getElementById('dni2');

            if (dniInput) {
                dniInput.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        setInterval(function() {
                            console.log("gaaa");
                            @this.call('registro');
                        }, 1000);
                    }
                });
            }

            if (dniInputt) {
                dniInputt.addEventListener('input', function() {
                    if (this.value.trim() !== '') {
                        setInterval(function() {
                            console.log("gaaa2");
                            @this.call('login');
                        }, 1000);
                    }
                });
            }
        });
    </script>
</div>
