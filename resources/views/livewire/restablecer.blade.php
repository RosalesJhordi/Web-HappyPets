<div class="w-full px-6 py-2">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <form wire:submit.prevent="restablecer" class="flex flex-col w-full gap-4">

        {{-- DNI --}}
        <div class="flex w-full border rounded-md border-rosa focus-within:ring-1 focus-within:ring-rosa">
            <span class="inline-flex items-center px-3 text-lg text-white border-none rounded-sm bg-rosa">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                </svg>
            </span>
            <input wire:model.live="dni" type="text"
                class="flex-1 block w-full p-2 bg-transparent border-none outline-none text-md rounded-e-lg focus:ring-rosa"
                placeholder="DNI">
        </div>
        @error('dni')
            <p class="p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">{{ $message }}</p>
        @enderror

        {{-- Nombres --}}
        <div class="flex w-full border rounded-md border-rosa focus-within:ring-1 focus-within:ring-rosa">
            <span class="inline-flex items-center px-3 text-lg text-white border-none rounded-sm bg-rosa">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 5.25a1.5 1.5 0 0 1 1.5-1.5h15a1.5 1.5 0 0 1 1.5 1.5v15a1.5 1.5 0 0 1-1.5 1.5h-15a1.5 1.5 0 0 1-1.5-1.5v-15ZM7.5 12h9M12 7.5v9" />
                </svg>
            </span>
            <input wire:model.live="nombres" type="text"
                class="flex-1 block w-full p-2 bg-transparent border-none outline-none text-md rounded-e-lg focus:ring-rosa"
                placeholder="Nombres">
        </div>
        @error('nombres')
            <p class="p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">{{ $message }}</p>
        @enderror

        {{-- Nueva Contraseña --}}
        <div class="flex w-full border rounded-md border-rosa focus-within:ring-1 focus-within:ring-rosa">
            <span class="inline-flex items-center px-3 text-lg text-white border-none rounded-sm bg-rosa">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 12v1.5m6-7.5a2.25 2.25 0 1 0-4.5 0v3M5.25 19.5h13.5m-10.5-4.5h7.5" />
                </svg>
            </span>
            <input wire:model.live="password" type="password"
                class="flex-1 block w-full p-2 bg-transparent border-none outline-none text-md rounded-e-lg focus:ring-rosa"
                placeholder="Nueva Contraseña">
        </div>
        @error('password')
            <p class="p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">{{ $message }}</p>
        @enderror

        {{-- Botón para guardar cambios --}}
        <button type="submit"
            class="w-full mt-5 text-white rounded btn bg-rosa hover:bg-rose-500">Restablecer Contraseña</button>
        <a href="{{ route('Registro') }}" class="w-full text-center btn btn-primary">Cancelar</a>
        </form>
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
