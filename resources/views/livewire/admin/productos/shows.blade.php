<div class="flex items-center justify-center">
    <div class="flex items-center justify-between border shadow-xl card card-side rounded-2xl"
        style="width: 60%; height: 55vh;">
        <figure class="w-1/2 h-full ">
            <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $datos['imagen'] }}"
                alt="Imagen servicio {{ $datos['nm_producto'] }}" class="object-fill w-full h-full" />
        </figure>

        <div class="w-1/2 h-full px-5 py-5">
            <h1 class="w-full text-2xl text-gray-400 text center">Datos</h1>
            <form action="" class="flex flex-col w-full gap-2 py-4" wire:submit.prevent="editardatos" novalidate>

                <label class="flex items-center gap-2 input input-bordered input-secondary">
                    Nomb. Producto:
                    <input type="text" id="large-input" wire:model.live='nm_producto' value="{{ $datos['nm_producto'] }}"
                        class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent">
                </label>


                <label class="flex items-center gap-2 input input-bordered input-secondary">
                    Descripcion:
                        <input type="text" id="large-input" wire:model.live='descripcion' value="{{ $datos['descripcion'] }}"
                        class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent">
                </label>

                <label class="flex items-center gap-2 input input-bordered input-secondary">
                    Categoria:
                        <input type="text" id="large-input" wire:model.live='categoria' value="{{ $datos['categoria'] }}"
                        class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent" disabled>
                </label>

                <label class="flex items-center gap-2 input input-bordered input-secondary">
                    Precio:
                    <input type="text" id="large-input" wire:model.live='precio' value="{{ $datos['precio'] }}"
                        class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent">
                </label>

                <label class="flex items-center gap-2 input input-bordered input-secondary">
                    Descuento:
                    <input type="text" id="large-input" wire:model.live='descuento' value="{{ $datos['descuento'] ?? 0 }}"
                        class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent">
                </label>

                <label class="flex items-center gap-2 input input-bordered input-secondary">
                    Colores:
                    <input type="text" id="large-input" wire:model.live='colores' value="{{ $datos['colores'] }}"
                        class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent">
                </label>

                <label class="flex items-center gap-2 input input-bordered input-secondary">
                    Stock:
                    <input type="text" id="large-input" wire:model.live='stock' value="{{ $datos['stock'] }}"
                        class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent">
                </label>

                <div class="flex items-center justify-end w-full gap-2 py-5">
                    <button type="submit"
                        class="flex items-center justify-center font-semibold text-blue-600 bg-blue-200 border border-blue-600 btn hover:bg-blue-600 hover:text-white">
                        Guardar cambios
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
                          </svg>
                    </button>
                    <button type="button" wire:click="delete"
                        class="flex items-center justify-center font-semibold text-red-600 bg-red-200 border border-red-600 btn hover:bg-red-600 hover:text-white">
                        Eliminar
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                          </svg>

                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($alert && session()->has('success'))
        <div>
            <label for="my_modal_6" class="hidden btn" wire:click="$set('alert', true)"></label>

            <input type="checkbox" id="my_modal_6" class="modal-toggle" wire:model="alert" />

            <div class="modal" style="{{ $alert ? '' : 'display: none;' }}">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2"
                            wire:click="alertfalse">✕</button>
                    </form>
                    <h3 class="text-3xl font-bold text-green-500">
                        <span>
                            <i class="fa-regular fa-circle-check"></i>
                        </span>
                        Exito
                    </h3>
                    <p class="py-4 text-2xl font-semibold text-gray-400">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif
</div>
