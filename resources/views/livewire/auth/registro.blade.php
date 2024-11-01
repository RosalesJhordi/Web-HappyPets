<div class="w-full px-6 py-2">

    @if ($mostrar)
        <form wire:submit.prevent="registro" @if ($dni != '' or $dni != null) wire:poll='registro' @endif novalidate
            class="flex flex-col w-full gap-4">
            @isset($exito)
                <p class="p-1 mt-2 font-semibold text-center text-green-600 bg-green-300 rounded-sm">{{ $exito['mensaje'] }}
                </p>
            @endisset
            {{-- dni --}}

            <div
                class="flex w-full border rounded-md border-rosa focus-within:ring-1 focus-within:ring-rosa">
                <span
                    class="inline-flex items-center px-3 text-lg text-white border-gray-300 border-none rounded-sm bg-rosa border-e-0 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        strokeWidth={1.5} stroke="currentColor" className="size-6">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                    </svg>

                </span>
                <input wire:model.live="dni" id="dni" type="text" id="website-admin"
                    class="flex-1 block w-full min-w-0 p-2 bg-transparent border-none rounded-none outline-none rounded-e-lg focus:ring-rosa text-md"
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

            <div class="flex border rounded-md border-rosa focus-within:ring-1 focus-within:ring-rosa">
                <span
                    class="inline-flex items-center px-3 text-lg text-white border border-none rounded-sm bg-rosa border-e-0 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                    </svg>
                </span>
                <input wire:model.live="telefono" value="{{ old('telefono') }}" type="text" id="website-admin"
                    class="flex-1 block w-full min-w-0 p-2 bg-transparent border-none rounded-none outline-none rounded-e-lg focus:ring-rosa text-md"
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

            <div class="flex border rounded-md border-rosa focus-within:ring-1 focus-within:ring-rosa">
                <span
                    class="inline-flex items-center px-3 text-lg text-white border-none rounded-sm bg-rosa border-e-0 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </span>
                <input wire:model.live="password" type="password" id="website-admin"
                    class="flex-1 block w-full min-w-0 p-2 bg-transparent border-none rounded-none outline-none rounded-e-lg focus:ring-rosa text-md"
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

            <div class="flex border rounded-md border-rosa focus-within:ring-1 focus-within:ring-rosa">
                <span
                    class="inline-flex items-center px-3 text-lg text-white border-none rounded-sm bg-rosa border-e-0 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>

                </span>
                <input wire:model.live="password_confirmation" type="text" id="website-admin"
                    class="flex-1 block w-full min-w-0 p-2 bg-transparent border-none rounded-none outline-none rounded-e-lg focus:ring-rosa text-md"
                    placeholder="Confima su contraseña">
            </div>

            {{-- boton --}}

            <button type="submit"
                class="w-full p-2 mt-5 text-white rounded bg-rosa btn hover:bg-rosa">Registro</button>
            <div class="divider">O</div>
            <p class="w-full mt-5 text-center">Ya tienes una cuenta?
                <button type="button" wire:click="mostrardiv2" class="font-semibold text-blue-700">Ingresar</button>
            </p>
        </form>
    @else
        <form wire:submit.prevent="login" @if ($dni2 != null or $dni2 != '') wire:poll='login' @endif novalidate
            class="flex flex-col gap-4">

            @if(session('exito'))
                <p class="p-1 mt-2 font-semibold text-center text-green-600 bg-green-300 rounded-sm">{{ session('exito') }}
                </p>
            @endif

            @if (session('error'))
                <div class="p-1 mt-2 font-semibold text-center text-red-600 bg-red-300 rounded-sm">
                    {{ session('error') }}
                </div>
            @endif


            {{-- DNI --}}
            <div
                class="flex w-full border rounded-md border-rosa focus-within:ring-1 focus-within:ring-rosa">
                <span
                    class="inline-flex items-center px-3 text-lg text-white border-gray-300 border-none rounded-sm bg-rosa border-e-0 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        strokeWidth={1.5} stroke="currentColor" className="size-6">
                        <path strokeLinecap="round" strokeLinejoin="round"
                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                    </svg>

                </span>
                <input wire:model.live="dni2" id="dni2" type="text" id="website-admin"
                    class="flex-1 block w-full min-w-0 p-2 bg-transparent border-none rounded-none outline-none rounded-e-lg focus:ring-rosa text-md"
                    placeholder="Ingresa su DNI" value="{{ old('dni') }}">
            </div>

            @isset($error['error']['dni'])
                <p class="p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">
                    {{ $error['error']['dni'][0] }}</p>
            @endisset

            {{-- Contraseña --}}
            <div class="flex border rounded-md border-rosa focus-within:ring-1 focus-within:ring-rosa">
                <span
                    class="inline-flex items-center px-3 text-lg text-white border-none rounded-sm bg-rosa border-e-0 ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </span>
                <input wire:model.live="password" type="password" id="website-admin"
                    class="flex-1 block w-full min-w-0 p-2 bg-transparent border-none rounded-none outline-none rounded-e-lg focus:ring-rosa text-md"
                    placeholder="Ingresa su contraseña">
            </div>

            @isset($error['error']['password'])
                <p class="p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">
                    {{ $error['error']['password'][0] }}</p>
            @endisset

            {{-- Botón de login --}}
            <button type="submit" class="w-full p-2 mt-5 text-white rounded bg-rosa btn hover:bg-rosa">Login</button>

            <div class="divider">O</div>
            <p class="w-full mt-5 text-center">No tienes una cuenta?
                <button type="button" wire:click="mostrardiv1"
                    class="font-semibold text-blue-700">Registrate</button>
            </p>
        </form>
    @endif
</div>
