<div>
    @if ($mostrar)
        <form wire:submit.prevent="registro" novalidate
            class="flex flex-col gap-4">
            @isset($exito)
                <p class="text-green-600 bg-green-300 mt-2 p-1 text-center rounded-sm font-semibold">{{ $exito['mensaje'] }}
                </p>
            @endisset
            {{-- dni --}}
            <div
                class="border border-purple-600 flex justify-between rounded-md text-xl focus-within:ring-1 focus-within:ring-purple-600">
                <label for="dni"
                    class="w-10 flex justify-center items-center rounded-md bg-purple-200 border-x-2 border-purple-500 p-1.5 ">
                    <i class="fa-regular fa-address-card text-purple-600"></i>
                </label>
                <input wire:model.debounce.500ms="dni" type="text" name="dni" id="dni" autocomplete="dni"
                    placeholder="DNI" class="h-full rounded-md outline-none w-96 p-1.5 " value="{{ old('dni') }}">
            </div>

            @isset($error)
                @if (isset($error['error']['dni']))
                    <p class="text-red-600 bg-red-100 border border-red-600 p-1 text-center rounded-sm">
                        {{ $error['error']['dni'][0] }}
                    </p>
                @endif
            @endisset

            {{-- telefono --}}
            <div
                class="border border-purple-600 flex justify-between rounded-md text-xl focus-within:ring-1 focus-within:ring-purple-600">
                <label for="telefono"
                    class="w-10 flex justify-center items-center rounded-md bg-purple-200 border-x-2 border-purple-600 p-1.5 ">
                    <i class="fa-solid fa-phone text-purple-600"></i>
                </label>
                <input wire:model.debounce.500ms="telefono" type="text" name="telefono" id="telefono"
                    autocomplete="telefono" placeholder="Telefono" class="h-full rounded-md outline-none w-96 p-1.5 "
                    value="{{ old('telefono') }}">
            </div>

            @isset($error)
                @if (isset($error['error']['telefono']))
                    <p class="text-red-600 bg-red-100 border border-red-600 p-1 text-center rounded-sm">
                        {{ $error['error']['telefono'][0] }}
                    </p>
                @endif
            @endisset
            {{-- contraseña --}}

            <div
                class="border border-purple-600 flex justify-between rounded-md text-xl focus-within:ring-1 focus-within:ring-purple-600">
                <label for="password"
                    class="w-10 flex justify-center items-center rounded-md bg-purple-200 border-x-2 border-purple-600 p-1.5 ">
                    <i class="fa-solid fa-unlock text-purple-600"></i>
                </label>
                <input wire:model.debounce.500ms="password" type="password" name="password" id="password"
                    autocomplete="password" placeholder="Contraseña" class="h-full rounded-md outline-none w-96 p-1.5 ">
            </div>

            @isset($error)
                @if (isset($error['error']['password']))
                    <p class="text-red-600 bg-red-100 border border-red-600 p-1 text-center rounded-sm">
                        {{ $error['error']['password'][0] }}
                    </p>
                @endif
            @endisset

            {{-- confirmacion de contraseña --}}
            <div
                class="border border-purple-600 flex justify-between rounded-md text-xl focus-within:ring-1 focus-within:ring-purple-600">
                <label for="password_confirmation"
                    class="w-10 flex justify-center items-center rounded-md bg-purple-200 border-x-2 border-purple-600 p-1.5 ">
                    <i class="fa-solid fa-unlock text-purple-600"></i>
                </label>
                <input wire:model.debounce.500ms="password_confirmation" type="password" name="password_confirmation"
                    id="password_confirmation" autocomplete="password_confirmation" placeholder="Confirma Contraseña"
                    class="h-full rounded-md outline-none w-96 p-1.5 ">
            </div>

            {{-- boton --}}

            <button type="submit"
                class="mt-5 w-full bg-purple-700 text-white p-2 rounded hover:bg-purple-600">Registro</button>
            <div class="divider">O</div>
            <p class="w-full text-center mt-5">Ya tienes una cuenta?
                <button type="button" wire:click="mostrardiv2" class="text-blue-700 font-semibold">Ingresar</button>
            </p>
        </form>
    @else
        <form wire:submit.prevent="login" novalidate class="flex flex-col gap-4">

            @isset($exito)
                <p class="text-green-600 bg-green-300 mt-2 p-1 text-center rounded-sm font-semibold">{{ $exito['mensaje'] }}
                </p>
            @endisset

            {{-- DNI --}}
            <div
                class="border border-purple-600 flex justify-between rounded-md text-xl focus-within:ring-1 focus-within:ring-purple-600">
                <label for="dni"
                    class="w-10 flex justify-center items-center rounded-md bg-purple-200 border-x-2 border-purple-500 p-1.5">
                    <i class="fa-regular fa-address-card text-purple-600"></i>
                </label>
                <input wire:model.debounce.500ms="dni2" type="text" name="dni2" id="dni2" autocomplete="dni2"
                    placeholder="DNI" class="h-full rounded-md outline-none w-96 p-1.5" value="{{ old('dni') }}">
            </div>

            @isset($error['error']['dni'])
                <p class="text-red-600 bg-red-100 border border-red-600 p-1 text-center rounded-sm">
                    {{ $error['error']['dni'][0] }}</p>
            @endisset

            {{-- Contraseña --}}
            <div
                class="border border-purple-600 flex justify-between rounded-md text-xl focus-within:ring-1 focus-within:ring-purple-600">
                <label for="password"
                    class="w-10 flex justify-center items-center rounded-md bg-purple-200 border-x-2 border-purple-600 p-1.5">
                    <i class="fa-solid fa-unlock text-purple-600"></i>
                </label>
                <input wire:model.debounce.500ms="password" type="password" name="password" id="password"
                    autocomplete="password" placeholder="Contraseña" class="h-full rounded-md outline-none w-96 p-1.5">
            </div>

            @isset($error['error']['password'])
                <p class="text-red-600 bg-red-100 border border-red-600 p-1 text-center rounded-sm">
                    {{ $error['error']['password'][0] }}</p>
            @endisset

            {{-- Botón de login --}}
            <button type="submit"
                class="mt-5 w-full bg-purple-700 text-white p-2 rounded hover:bg-purple-600">Login</button>

            <div class="divider">O</div>
            <p class="w-full text-center mt-5">No tienes una cuenta?
                <button type="button" wire:click="mostrardiv1" class="text-blue-700 font-semibold">Registrate</button>
            </p>
        </form>
    @endif
</div>

<script>
    document.getElementById('dni').addEventListener('input', function() {
        let dniInput = this.value;

        if (dniInput.trim() !== '') {
            setInterval(function() {
                @this.call('registro');
            }, 1000);
        }
    });
</script>

<script>
    document.getElementById('dni2').addEventListener('input', function() {
        let dniInputt = this.value;

        if (dniInputt.trim() !== '') {
            setInterval(function() {
                @this.call('login');
            }, 1000);
        }
    });
</script>

