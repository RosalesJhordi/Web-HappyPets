{{-- admin.productos.productos --}}
<div class="w-full px-5">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <div class="flex w-full gap-5 py-5">
        @livewire('admin.secciones.productos-count')
        <button onclick="my_modal_3.showModal()"
            class="flex items-center justify-start w-full h-32 gap-2 px-5 py-5 text-gray-400 bg-white border rounded-sm shadow-md md:w-1/5">
            <span class="flex items-center justify-center text-xl text-green-600 bg-green-200 rounded-full w-14 h-14">
                <i class="fa-solid fa-plus"></i>
            </span>
            <span>
                <h1 class="text-lg font-bold text-gray-400">Añadir Producto</h1>
            </span>
        </button>
        {{-- modal --}}
        <dialog id="my_modal_3" class="modal" wire:ignore.self>
            <div class="w-11/12 max-w-6xl modal-box">
                <form method="dialog">
                    <button class="absolute btn btn-xl btn-circle btn-ghost right-2 top-2">✕</button>
                </form>
                <h3 class="text-lg font-bold">Agregar nuevo producto</h3>

                <form class="flex flex-col items-center justify-center gap-2 px-5 py-5"
                    wire:submit.prevent="addProducto" novalidate>

                    @if (session('mensaje'))
                        <div
                            class="flex items-center justify-center w-full gap-2 p-1 text-center text-green-600 bg-green-100 border border-green-600 rounded-sm">
                            <i class="fa-solid fa-check"></i>
                            <span>{{ session('mensaje') }}.</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div
                            class="flex items-center justify-center w-full gap-2 p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">
                            <i class="fa-solid fa-xmark"></i>
                            <span>{{ session('error') }}.</span>
                        </div>
                    @endif

                    <div class="grid w-full grid-cols-1 gap-6 xl:grid-cols-2">

                        <div class="flex items-center justify-center w-full h-full">
                            <label for="dropzone-file"
                                class="flex flex-col h-96 {{ $imagen ? 'border-green-600  bg-green-200' : 'border-gray-300 bg-slate-100' }} items-center justify-center w-full h-64 border-2  border-dashed rounded-lg cursor-pointer">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-10 h-10 mb-4 {{ $imagen ? 'text-green-600' : 'text-gray-500' }}"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-lg {{ $img ? 'text-green-600' : 'text-gray-500' }}""><span
                                            class="font-semibold">Seleciona </span> o arrastra y suelta imagen</p>
                                    <p class="text-lg {{ $img ? 'text-green-600' : 'text-gray-500' }}"">SVG, PNG, JPG o
                                        GIF</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" wire:model.live="imagen" />
                            </label>
                        </div>

                        <div class="flex flex-col items-center justify-center w-full h-full gap-2">

                            {{-- nombre producto --}}

                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <i class="fa-solid fa-plus"></i>
                                </div>
                                <input wire:model.live="nm_producto" type="text" id="input-group-1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                    placeholder="Nomb. Producto">
                            </div>

                            {{-- descripcion producto --}}

                            <textarea id="message" rows="4" wire:model.live="descripcion"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 "
                                placeholder="Descripcion corta del producto"></textarea>


                            {{-- categoria --}}

                            <select id="categoria" wire:model.live="categoria"
                                class="bg-gray-50 border cursor-pointer border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                <option selected>Seleciona Categoria</option>
                                <option value="Accesorio">Accesorio</option>
                                <option value="Alimentos y Golosinas">Alimentos y Golosinas</option>
                                <option value="Juguetes">Juguetes</option>
                                <option value="Ropa">Ropa</option>
                                <option value="Camas">Camas</option>
                                <option value="Medicamentos">Medicamentos</option>
                            </select>

                            {{-- colores --}}
                            @php
                                $colors = [
                                    'Blanco' => '#FFFFFF',
                                    'Rojo' => '#FF0000',
                                    'Azul' => '#0000FF',
                                    'Verde' => '#00FF00',
                                    'Morado' => '#800080', // Agregado
                                    'Amarillo' => '#FFFF00', // Agregado
                                    'Negro' => '#000000', // Agregado
                                ];
                            @endphp

                            <label
                                class="block w-full px-2 mt-2 mb-2 text-sm font-medium text-gray-900 text-start">Selecciona
                                colores</label>
                            <p>{{ implode(', ', $colores) }}</p>

                            <div
                                class="grid items-center justify-start w-full grid-cols-4 gap-4 px-2 py-2 mb-4 md:grid-cols-7">
                                @foreach ($colors as $colorName => $colorHex)
                                    <label wire:click='actualizarcolor("{{ $colorName }}")'
                                        style="background-color: {{ $colorHex }}"
                                        class="w-6 h-6 relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 focus:outline-none {{ in_array($colorName, $colores) ? 'ring-4 ring-blue-500' : 'ring-4 ring-transparent' }}">
                                        <input type="checkbox" wire:model="colores" value="{{ $colorName }}"
                                            class="sr-only">
                                        <span class="w-5 h-5 border border-black rounded-full border-opacity-10"
                                            style="background-color: {{ $colorHex }};"></span>
                                    </label>
                                @endforeach
                            </div>


                            {{-- precio --}}

                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <i class="fa-solid fa-hand-holding-dollar"></i>
                                </div>
                                <input wire:model.live="precio" type="text" id="input-group-1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                    placeholder="Precio">
                            </div>

                            {{-- desccuento --}}

                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <i class="fa-solid fa-percent"></i>
                                </div>
                                <input wire:model.live="descuento" type="text" id="input-group-1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                    placeholder="Descuento">
                            </div>

                            {{-- stock --}}

                            <div class="relative w-full">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                    <i class="fa-solid fa-boxes-stacked"></i>
                                </div>
                                <input wire:model.live="stock" type="text" id="input-group-1"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 "
                                    placeholder="Stock">
                            </div>

                            <button type="submit"
                                class="w-full p-2 mt-5 text-white bg-purple-700 rounded hover:bg-purple-600">Agregar
                                Producto</button>
                        </div>

                    </div>
                </form>
            </div>
        </dialog>
    </div>

    @if ($ver)
        <button wire:click="ocultar" type="button" class="w-20 text-xl btn btn-primary">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        <div class="flex items-center justify-center">

            <div class="flex items-center justify-between border shadow-xl card card-side rounded-2xl"
                style="width: 60%; height: 55vh;">
                <figure class="w-1/2 h-full ">
                    <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $data['imagen'] }}"
                        alt="Imagen servicio {{ $data['nm_producto'] }}" class="object-fill w-full h-full" />
                </figure>

                <div class="w-1/2 h-full px-5 py-5">
                    <h1 class="w-full text-2xl text-gray-400 text center">Datos</h1>
                    <form action="" class="flex flex-col w-full gap-2 py-4" wire:submit.prevent="editardatos"
                        novalidate>

                        <label class="flex items-center gap-2 input input-bordered input-secondary">
                            Nomb. Producto:
                            <input type="text" id="large-input" wire:model.live='nm_producto'
                                value="{{ $data['nm_producto'] }}"
                                class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent">
                        </label>


                        <label class="flex items-center gap-2 input input-bordered input-secondary">
                            Descripcion:
                            <input type="text" id="large-input" wire:model.live='descripcion'
                                value="{{ $data['descripcion'] }}"
                                class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent">
                        </label>

                        <label class="flex items-center gap-2 input input-bordered input-secondary">
                            Categoria:
                            <input type="text" id="large-input" wire:model.live='categoria'
                                value="{{ $data['categoria'] }}"
                                class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent"
                                disabled>
                        </label>

                        <label class="flex items-center gap-2 input input-bordered input-secondary">
                            Precio:
                            <input type="text" id="large-input" wire:model.live='precio'
                                value="{{ $data['precio'] }}"
                                class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent">
                        </label>

                        <label class="flex items-center gap-2 input input-bordered input-secondary">
                            Descuento:
                            <input type="text" id="large-input" wire:model.live='descuento'
                                value="{{ $data['descuento'] ?? 0 }}"
                                class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent">
                        </label>

                        <label class="flex items-center gap-2 input input-bordered input-secondary">
                            Colores:
                            <input type="text" id="large-input" wire:model.live='colorr'
                                value="{{ $data['colores'] }}"
                                class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent">
                        </label>

                        <label class="flex items-center gap-2 input input-bordered input-secondary">
                            Stock:
                            <input type="text" id="large-input" wire:model.live='stock'
                                value="{{ $data['stock'] }}"
                                class="block w-1/2 p-4 text-base text-gray-900 border-none rounded-lg full w- bg-gray-50 focus:ring-transparent">
                        </label>

                        <div class="flex items-center justify-end w-full gap-2 py-5">
                            <button type="submit"
                                class="flex items-center justify-center font-semibold text-blue-600 bg-blue-200 border border-blue-600 btn hover:bg-blue-600 hover:text-white">
                                Guardar cambios
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
                                </svg>
                            </button>
                            <button type="button" wire:click="delete" wire:confirm="Estas seguro que deseas eliminar este producto ?"
                                class="flex items-center justify-center font-semibold text-red-600 bg-red-200 border border-red-600 btn hover:bg-red-600 hover:text-white">
                                Eliminar
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    @else
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
        {{-- filtro --}}
        <div class="relative flex items-center justify-between py-2">
            <h1 class="py-2 font-extrabold text-gray-400 lg:text-xl text-md">Tabla Productos</h1>
            {{-- buscador --}}
            <label class="flex items-center w-1/3 gap-2 p-1 input input-bordered">
                <input type="search" wire:model.live="buscado" id="default-search"
                    class="block w-full p-4 text-sm text-gray-900 border-none rounded-lg ps-10 bg-gray-50 focus:outline-none focus:ring-0 focus:border-transparent"
                    placeholder="Buscar por nombre" />
                <i class="px-2 text-xl text-gray-400 fa-solid fa-magnifying-glass"></i>
            </label>

            {{-- filtros --}}
            <div class="flex items-center justify-center gap-2">
                <details class="relative dropdown">
                    <summary class="m-1 cursor-pointer btn">
                        <i class="fa-solid fa-arrow-up-short-wide"></i>
                    </summary>

                    <!-- Contenido del dropdown -->
                    <div class="dropdown-content bg-gray-200 rounded-lg shadow-lg z-[1] right-0 absolute w-52 p-2">
                        <button type="button" class="w-full p-1 text-left rounded-md btn"
                            wire:click="showAll">Mostrar Todo</button>
                        <button type="button" class="w-full p-1 text-left rounded-md btn" wire:click="az">Ordenar
                            A-Z</button>
                        <button type="button" class="w-full p-1 text-left rounded-md btn" wire:click="za">Ordenar
                            Z-A</button>
                        <button type="button" class="w-full p-1 text-left rounded-md btn" wire:click='fechaup'>Más
                            Antiguos</button>
                        <button type="button" class="w-full p-1 text-left rounded-md btn" wire:click='fechadown'>Más
                            Recientes</button>
                        <button type="button" class="w-full p-1 text-left rounded-md btn"
                            wire:click='preciomax'>Precio Mayor</button>
                        <button type="button" class="w-full p-1 text-left rounded-md btn"
                            wire:click='preciomin'>Precio Menor</button>
                    </div>
                </details>

                <button type="button" wire:click='obtenerdatos' class="btn btn-primary">
                    <i class="fa-solid fa-rotate-right"></i>
                </button>
            </div>

        </div>
        {{-- tabla --}}
        <div class="w-full overflow-x-auto">
            <table class="relative table h-full py-5 bg-white table-zebra" style="width: 100%">
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
                        <th class="border">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    @foreach ($datos as $dato)
                        <tr wire:key="{{ $dato['id'] }}">
                            <td class="border">
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="w-20 h-12 mask mask-squircle">
                                            <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $dato['imagen'] }}"
                                                alt="Imagen servicio {{ $dato['nm_producto'] }}" class="w-full" />
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="border">
                                <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['nm_producto'] }}" disabled />
                            </td>
                            <td class="border">
                                <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['descripcion'] }}" disabled />
                            </td>
                            <td class="border">
                                <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['categoria'] }}" disabled />
                            </td>
                            <td class="w-10 border ">
                                <input type="text" class="w-20 bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['precio'] }}" disabled />
                            </td>
                            <td class="w-10 border">
                                <input type="text" class="w-10 bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['descuento'] ?? 0 }}" disabled />
                            </td>
                            <td class="w-10 border ">
                                <input type="text" class="w-20 bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['stock'] }}" disabled />
                            </td>
                            <td class="border">
                                {{ \Carbon\Carbon::parse($dato['created_at'])->locale('es')->diffForHumans() }}
                            </td>
                            <th class="border">
                                <div class="tooltip" data-tip="Ver">
                                    <button type="button" wire:click="verproducto({{ $dato['id'] }})"
                                        class="px-5 py-3 text-blue-500 bg-blue-200 border border-blue-500 badge"><i
                                            class="fa-regular fa-eye"></i></button>
                                </div>
                                <div class="tooltip" data-tip="Eliminar">
                                    <button wire:click='eliminar({{ $dato['id'] }})' wire:confirm="Estas seguro que deseas eliminar este producto ?"
                                        class="px-5 py-3 text-red-500 bg-red-200 border border-red-500 badge"><i
                                            class="fa-solid fa-trash"></i></button>
                                </div>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
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
