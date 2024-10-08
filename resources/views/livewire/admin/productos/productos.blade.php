<div class="w-full px-5">
    <div class="w-full py-5 flex gap-5">
        <div
            class="w-1/5 h-32 bg-white border rounded-sm shadow-md text-gray-400 px-5 py-5 flex justify-start items-center gap-2">
            <span class="rounded-full text-blue-600 bg-blue-200 w-14 h-14 flex justify-center items-center text-xl">
                <i class="fa-solid fa-bowl-food"></i>
            </span>
            <span>
                <h1 class="text-3xl text-gray-900 font-bold">{{ count($totalproductos) }}</h1>
                <h2 class="text-sm font-semibold">Productos Totales</h2>
            </span>
        </div>

        <button onclick="my_modal_3.showModal()"
            class="w-1/5 h-32 bg-white border rounded-sm shadow-md text-gray-400 px-5 py-5 flex justify-start items-center gap-2">
            <span class="rounded-full text-green-600 bg-green-200 w-14 h-14 flex justify-center items-center text-xl">
                <i class="fa-solid fa-plus"></i>
            </span>
            <span>
                <h1 class="text-lg text-gray-400 font-bold">Añadir Producto</h1>
            </span>
        </button>
        {{-- modal --}}
        <dialog id="my_modal_3" class="modal" wire:ignore.self>
            <div class="modal-box">
                <form method="dialog">
                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                </form>
                <h3 class="text-lg font-bold">Agregar nuevo producto</h3>

                <form class="py-5 px-5 flex flex-col gap-2 items-center justify-center"
                    wire:submit.prevent="addProducto" novalidate>

                    @if (session('mensaje'))
                        <div
                            class="w-full gap-2 flex text-center justify-center items-center p-1 rounded-sm bg-green-100 text-green-600 border border-green-600">
                            <i class="fa-solid fa-check"></i>
                            <span>{{ session('mensaje') }}.</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div
                            class="w-full gap-2 flex text-center justify-center items-center p-1 rounded-sm bg-red-100 text-red-600 border border-red-600">
                            <i class="fa-solid fa-xmark"></i>
                            <span>{{ session('error') }}.</span>
                        </div>
                    @endif
                    {{-- nombre producto --}}
                    <label class="input input-bordered flex items-center gap-2 w-full">
                        <i class="fa-solid fa-plus"></i>
                        <input type="text" wire:model.debounce.500ms="nm_producto" class="grow"
                            placeholder="Nomb. Producto" />
                    </label>

                    {{-- descripcion --}}
                    <textarea class="textarea textarea-bordered w-full" placeholder="Descripcion" wire:model.debounce.500ms="descripcion"></textarea>

                    {{-- categoria --}}
                    <select class="select select-bordered w-full" wire:model.debounce.500ms="categoria">
                        <option disabled selected>Seleciona Categoria</option>
                        <option>Accesorio</option>
                        <option>Alimentos y Golosinas</option>
                        <option>Cuidado y Higiene</option>
                        <option>Juguetes</option>
                        <option>Ropa</option>
                        <option>Camas</option>
                    </select>

                    {{-- precio --}}
                    <label class="input input-bordered flex items-center gap-2 w-full">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                        <input type="text" class="grow" placeholder="Precio" wire:model.debounce.500ms="precio" />
                    </label>

                    {{-- desccuento --}}
                    <label class="input input-bordered flex items-center gap-2 w-full">
                        <i class="fa-solid fa-percent"></i>
                        <input type="text" class="grow" placeholder="Descuento (Opcional)"
                            wire:model.debounce.500ms="descuento" />
                    </label>

                    {{-- stock --}}
                    <label class="input input-bordered flex items-center gap-2 w-full">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <input type="text" class="grow" placeholder="Stock" wire:model.debounce.500ms="stock" />
                    </label>

                    {{-- imagen --}}
                    <input type="file" class="file-input file-input-bordered w-full" wire:model="imagen" />

                    <button type="submit"
                        class="mt-5 w-full bg-purple-700 text-white p-2 rounded hover:bg-purple-600">Agregar
                        Producto</button>
                </form>
            </div>
        </dialog>
    </div>

    @if ($ver)
        <button wire:click='ocultar' type="button" class="btn btn-primary text-xl w-20">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        @livewire('admin.productos.shows',['id' => $id])
    @else

        {{-- filtro --}}
        <div class="flex justify-between items-center relative">
            <h1 class="text-gray-400 font-extrabold text-xl py-2">Tabla Productos</h1>
            <div class="flex justify-center items-center gap-2">
                <p class="text-gray-400 font-semibold">{{ $filtro }}</p>
                <details class="dropdown">
                    <summary class="btn m-1">
                        <i class="fa-solid fa-arrow-up-short-wide"></i>
                    </summary>
                    <ul
                        class="menu dropdown-content bg-gray-200 rounded-box z-[1] right-0 absolute w-52 p-2 shadow gap-2">
                        <button type="button" class="p-1 rounded-md btn" wire:click="showAll">Mostrar Todo</button>
                        <button type="button" class="p-1 rounded-md btn" wire:click="az">Ordenar A-Z</button>
                        <button type="button" class="p-1 rounded-md btn" wire:click="za">Ordenar Z-A</button>
                        <button type="button" class="p-1 rounded-md btn" wire:click='fechaup'>Mas Antiguos</button>
                        <button type="button" class="p-1 rounded-md btn" wire:click='fechadown'>Mas Recientes</button>

                        <button type="button" class="p-1 rounded-md btn" wire:click='preciomax'>Precio Mayor</button>

                        <button type="button" class="p-1 rounded-md btn" wire:click='preciomin'>Precio Menor</button>
                    </ul>
                </details>
            </div>
        </div>
   
        {{-- tabla --}}
        <table class="table table-zebra h-full relative py-5 bg-white" style="width: 100%">
            <!-- head -->
            <thead>
                <tr class="border">
                    <th class="border">Imagen</th>
                    <th class="border">Nomb. Producto</th>
                    <th class="border">Descripcion</th>
                    <th class="border">Categoría</th>
                    <th class="border">Precio</th>
                    <th class="border">Descuento</th>
                    <th class="border">Stock</th>
                    <th class="border">Fecha Creacion</th>
                    <th class="border w-56">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- row 1 -->
                @foreach ($datos as $dato)
                    <tr>
                        <td class="border">
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="mask mask-squircle h-12 w-20">
                                        <img src="{{ 'https://api-happypetshco-com.preview-domain.com/ServidorProductos/' . $dato['imagen'] }}"
                                            alt="Imagen servicio {{ $dato['nm_producto'] }}" class="w-full" />
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="border">
                            <input type="text" class="border-none bg-transparent w-auto focus:outline-none"
                                value="{{ $dato['nm_producto'] }}" disabled />
                        </td>
                        <td class="border">
                            <input type="text" class="border-none bg-transparent w-auto focus:outline-none"
                                value="{{ $dato['descripcion'] }}" disabled />
                        </td>
                        <td class="border">
                            <input type="text" class="border-none bg-transparent w-auto focus:outline-none"
                                value="{{ $dato['categoria'] }}" disabled />
                        </td>
                        <td class="border w-10 ">
                            <input type="text" class="border-none bg-transparent w-20 focus:outline-none"
                                value="{{ $dato['precio'] }}" disabled />
                        </td>
                        <td class="border w-10">
                            <input type="text" class="border-none bg-transparent w-10 focus:outline-none"
                                value="{{ $dato['descuento'] ?? 0 }}" disabled />
                        </td>
                        <td class="border w-10 ">
                            <input type="text" class="border-none bg-transparent w-20 focus:outline-none"
                                value="{{ $dato['stock'] }}" disabled />
                        </td>
                        <td class="border">
                            {{ \Carbon\Carbon::parse($dato['created_at'])->locale('es')->diffForHumans() }}
                        </td>
                        <th class="border">
                            <div class="tooltip" data-tip="Ver">
                                <button type="button" wire:click="verproducto('{{ $dato['id'] }}')"
                                    class="badge py-3 px-5  bg-blue-200 text-blue-500 border border-blue-500"><i
                                        class="fa-regular fa-eye"></i></button>
                            </div>
                            <div class="tooltip" data-tip="Editar">
                                <button class="badge py-3 px-5  bg-green-200 text-green-500 border border-green-500"><i
                                        class="fa-solid fa-pen"></i></button>
                            </div>
                            <div class="tooltip" data-tip="Eliminar">
                                <button class="badge py-3 px-5  bg-red-200 text-red-500 border border-red-500"><i
                                        class="fa-solid fa-trash"></i></button>
                            </div>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
