<div class="flex justify-center items-center">
    <div class="shadow-xl card card-side rounded-2xl border flex justify-between items-center"
        style="width: 60%; height: 55vh;">
        <figure class="w-1/2 h-full ">
            <img src="{{ 'https://api-happypetshco-com.preview-domain.com/ServidorProductos/' . $datos['imagen'] }}"
                alt="Imagen servicio {{ $datos['nm_producto'] }}" class="w-full h-full object-fill" />
        </figure>

        <div class="w-1/2 h-full px-5 py-5">
            <h1 class="w-full text center text-gray-400 text-2xl">Datos</h1>
            <form action="" class="w-full py-4 flex flex-col gap-2" wire:submit.prevent="editardatos" novalidate>

                <label class="input input-bordered input-secondary flex items-center gap-2">
                    Nomb. Producto:
                    <input type="text" wire:model.debounce.500ms='nm_producto' value="{{ $datos['nm_producto'] }}"
                        class="grow" />
                </label>


                <label class="input input-bordered input-secondary flex items-center gap-2">
                    Descripcion:
                    <input type="text" wire:model.debounce.500ms='descripcion' value="{{ $datos['descripcion'] }}"
                        class="grow" />
                </label>

                <label class="input input-bordered input-secondary flex items-center gap-2">
                    Categoria:
                    <input type="text" wire:model.debounce.500ms='categoria' value="{{ $datos['categoria'] }}"
                        class="grow" disabled />
                </label>

                <label class="input input-bordered input-secondary flex items-center gap-2">
                    Precio:
                    <input type="text" wire:model.debounce.500ms='precio' value="{{ $datos['precio'] }}"
                        class="grow" />
                </label>

                <label class="input input-bordered input-secondary flex items-center gap-2">
                    Descuento:
                    <input type="text" wire:model.debounce.500ms='descuento' value="{{ $datos['descuento'] ?? 0 }}"
                        class="grow" />
                </label>

                <label class="input input-bordered input-secondary flex items-center gap-2">
                    Stock:
                    <input type="text" wire:model.debounce.500ms='stock' value="{{ $datos['stock'] }}"
                        class="grow" />
                </label>

                <div class="w-full flex gap-2 py-5 justify-end items-center">
                    <button type="submit"
                        class="btn bg-blue-200 font-semibold border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white">Guardar
                        cambios</button>
                    <button type="button" wire:click="delete"
                        class="btn bg-red-200 font-semibold border border-red-600 text-red-600 hover:bg-red-600 hover:text-white">eliminar</button>
                </div>
            </form>
        </div>
    </div>

    @if ($alert && session()->has('success'))
        <div>
            <label for="my_modal_6" class="btn hidden" wire:click="$set('alert', true)"></label>

            <input type="checkbox" id="my_modal_6" class="modal-toggle" wire:model="alert" />

            <div class="modal" style="{{ $alert ? '' : 'display: none;' }}">
                <div class="modal-box">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2" wire:click="alertfalse">✕</button>
                    </form>
                    <h3 class="text-3xl font-bold text-green-500">
                        <span>
                            <i class="fa-regular fa-circle-check"></i>
                        </span>
                        Exito
                    </h3>
                    <p class="py-4 text-2xl text-gray-400 font-semibold">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif
</div>
