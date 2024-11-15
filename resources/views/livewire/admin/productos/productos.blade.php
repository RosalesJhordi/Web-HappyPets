{{-- admin.productos.productos --}}
<div class="w-full">
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
                                            class="font-semibold">Seleciona </span> imagen del producto</p>
                                    <p class="text-lg {{ $img ? 'text-green-600' : 'text-gray-500' }}"">SVG, PNG, WEBP,
                                        JPG o
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


                            <div class="flex items-end justify-end w-full gap-2">
                                {{-- Categoria --}}
                                <select wire:loading.remove id="categoria" wire:model.live="categoria"
                                    class="border cursor-pointer  text-gray-900 text-sm rounded-lg {{ $categoria ? 'bg-green-200 border-green-600 text-green-600 font-semibold' : 'bg-gray-50 border-gray-300' }} focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                                    <option selected>Selecciona Categoria</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                                    @endforeach
                                </select>


                                {{-- Sub Categoria --}}
                                @if ($sub_categoria)
                                    <select wire:loading.remove id="subcategoria" wire:model.live="subcategoria"
                                        class="w-full border cursor-pointer text-gray-900 {{ $subcategoria ? 'bg-blue-200 border-blue-600 text-blue-600 font-semibold' : 'bg-gray-50 border-gray-300' }} text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 ">
                                        <option selected>Selecciona Sub Categoria</option>
                                        @foreach ($sub_categoria as $subcat)
                                            <option value="{{ $subcat['id'] }}">{{ $subcat['nombre'] }}</option>
                                        @endforeach
                                    </select>
                                @endif

                                {{-- Sub Sub Categoria --}}
                                @if (is_array($sub_sub_categoria) && !empty($sub_sub_categoria))
                                    <select wire:loading.remove id="sub_sub_categoria" wire:model.live="subsubcategoria"
                                        class=" border w-full pl-4 cursor-pointer  {{ $subsubcategoria ? 'bg-orange-200 border-orange-600 text-orange-600 font-semibold' : 'bg-gray-50 border-gray-300' }} text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5 ">
                                        <option selected>Seleciona sub sub Categoria</option>
                                        @foreach ($sub_sub_categoria as $subsubcategoria)
                                            <option value="{{ $subsubcategoria['id'] }}">
                                                {{ $subsubcategoria['nombre'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                @endif

                            </div>

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
                            ]; @endphp
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

                            <button wire:loading.remove type="submit"
                                class="w-full p-2 mt-5 text-white bg-purple-700 rounded hover:bg-purple-600">
                                Agregar Producto

                            </button>

                            <button wire:loading
                                class="w-full mt-5 text-white bg-purple-700 rounded hover:bg-purple-600">
                                <span class="p-2 loading loading-spinner loading-md"></span>
                            </button>

                        </div>

                    </div>
                </form>
            </div>
        </dialog>
    </div>

    @if ($ver)
        <button wire:click="ocultar" type="button" class="text-xl btn btn-primary">
            x
        </button>
        <div class="flex items-center justify-center">

            <div class="flex items-center justify-between h-auto border rounded-sm shadow-xl card card-side"
                style="width: 60%;">
                <figure class="w-1/2 h-full ">
                    <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $data['imagen'] }}"
                        alt="Imagen servicio {{ $data['nm_producto'] }}" class="object-fill w-full h-full" />
                </figure>

                <div class="w-1/2 h-full px-5 py-5 bg-slate-50">
                    <h1 class="w-full text-2xl text-gray-400 text center">Datos</h1>
                    <form class="flex flex-col w-full gap-2 py-4" wire:submit.prevent="editardatos" novalidate>

                        <label class="flex items-center gap-2 input input-bordered">
                            <input type="text" id="large-input" wire:model.live='nm_producto'
                                value="{{ $data['nm_producto'] }}"
                                class="block w-full p-4 text-base text-gray-900 border-none rounded-lg bg-gray-50 focus:ring-transparent">
                            <span class="w-1/2 text-white badge bg-rosa">Nomb. Producto</span>
                        </label>

                        <label class="flex items-start h-auto gap-2 input input-bordered">
                            <textarea id="large-input" wire:model.live='descripcion'
                                      class="block w-full p-4 text-base text-gray-900 border-none rounded-lg bg-gray-50 focus:ring-transparent"
                                      rows="4">{{ $data['descripcion'] }}</textarea>
                            <span class="w-1/2 text-white bg-blue-500 badge">Descripcion</span>
                        </label>

                        <label class="flex items-center gap-2 input input-bordered">
                            <input type="text" id="large-input" wire:model.live='precio'
                                value="{{ $data['precio'] }}"
                                class="block w-full p-4 text-base text-gray-900 border-none rounded-lg bg-gray-50 focus:ring-transparent">
                            <span class="w-1/2 text-white bg-green-500 badge">Precio</span>
                        </label>

                        <label class="flex items-center gap-2 input input-bordered">
                            <input type="text" id="large-input" wire:model.live='descuento'
                                value="{{ $data['descuento'] }}"
                                class="block w-full p-4 text-base text-gray-900 border-none rounded-lg bg-gray-50 focus:ring-transparent">
                            <span class="w-1/2 py-2 text-white bg-red-500 badge">Descuento</span>
                        </label>

                        <label class="flex items-center gap-2 input input-bordered">
                            <input type="text" id="large-input" wire:model.live='colorr'
                                value="{{ $data['colores'] }}"
                                class="block w-full p-4 text-base text-gray-900 border-none rounded-lg bg-gray-50 focus:ring-transparent">
                            <span class="w-1/2 py-2 text-white bg-teal-500 badge">Colores</span>
                        </label>
                        <div class="label">
                            <span class="label-text-alt">Ejemplo: Blanco, Rojo, Azul, Verde, Morado, Amarillo</span>
                        </div>

                        <label class="flex items-center gap-2 input input-bordered">
                            <input type="text" id="large-input" wire:model.live='stock'
                                value="{{ $data['stock'] }}"
                                class="block w-full p-4 text-base text-gray-900 border-none rounded-lg bg-gray-50 focus:ring-transparent">
                            <span class="w-1/2 py-2 text-white bg-indigo-500 badge">Stock</span>
                        </label>

                        <div class="flex items-center justify-end w-full gap-2 py-5">
                            <button wire:loading.remove type="submit"
                                class="flex items-center justify-center font-semibold text-blue-600 bg-blue-200 border border-blue-600 btn hover:bg-blue-600 hover:text-white">
                                Guardar cambios
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
                                </svg>
                            </button>
                            <button wire:loading type="button"  class="flex items-center justify-center font-semibold text-blue-600 bg-blue-200 border border-blue-600 btn hover:bg-blue-600 hover:text-white" disabled>
                                <span class="loading loading-spinner loading-sm"></span>
                                Procesando...
                              </button>
                            <button type="button" wire:click="delete"
                                wire:confirm="Estas seguro que deseas eliminar este producto ?"
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

                <div class="dropdown dropdown-bottom dropdown-end bg-base-100">
                    <div tabindex="0" role="button" class="m-1 btn">
                        Categorias
                        <span class="pl-2">
                            <i class="fa-solid fa-arrow-up-a-z"></i>
                        </span>
                    </div>
                    <ul tabindex="0" class="dropdown-content menu bg-gray-200  rounded-box z-[1] w-52 p-2 shadow">
                        <button type="button"
                            class="w-full p-1 text-left rounded-md border-0 btn {{ $cat == 'Todos' ? 'bg-blue-600 hover:bg-blue-400 text-white' : 'bg-gray-200' }}"
                            wire:click="filtrarCategoria('Todos')">Mostrar Todo</button>

                        @foreach ($categoriasAll as $todascategorias)
                            <button wire:click="filtrarCategoria('{{ $todascategorias['nombre'] }}')" type="button"
                                class="btn rounded-md border-0  {{ $cat == $todascategorias['nombre'] ? 'bg-blue-600 hover:bg-blue-400 text-white' : 'bg-gray-200' }}">
                                {{ $todascategorias['nombre'] }}
                            </button>
                        @endforeach

                    </ul>
                </div>

                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="m-1 btn">
                        <i class="fa-solid fa-arrow-up-short-wide"></i>
                    </div>

                    <!-- Contenido del dropdown -->
                    <ul tabindex="0"
                        class=" menu dropdown-content bg-gray-200 rounded-lg shadow-lg z-[1] right-0 absolute w-52 p-2">
                        <button type="button"
                            class="w-full p-1 text-left rounded-md border-0 btn {{ $filtro == 'Todos' ? 'bg-blue-600 hover:bg-blue-400 text-white' : 'bg-gray-200' }}"
                            wire:click="showAll">Mostrar Todo</button>
                        <button type="button"
                            class="w-full p-1 text-left rounded-md border-0 btn {{ $filtro == 'A - Z' ? 'bg-blue-600 hover:bg-blue-400 text-white' : 'bg-gray-200' }}"
                            wire:click="az">Ordenar
                            A-Z</button>
                        <button type="button"
                            class="w-full p-1 text-left rounded-md border-0 btn {{ $filtro == 'Z - A' ? 'bg-blue-600 hover:bg-blue-400 text-white' : 'bg-gray-200' }}"
                            wire:click="za">Ordenar
                            Z-A</button>
                        <button type="button"
                            class="w-full p-1 text-left rounded-md border-0 btn {{ $filtro == 'ANTIGUOS' ? 'bg-blue-600 hover:bg-blue-400 text-white' : 'bg-gray-200' }}"
                            wire:click='fechaup'>Más
                            Antiguos</button>
                        <button type="button"
                            class="w-full p-1 text-left rounded-md border-0 btn {{ $filtro == 'RECIENTES' ? 'bg-blue-600 hover:bg-blue-400 text-white' : 'bg-gray-200' }}"
                            wire:click='fechadown'>Más
                            Recientes</button>
                        <button type="button"
                            class="w-full p-1 text-left rounded-md border-0 btn {{ $filtro == 'PRECIO MIN' ? 'bg-blue-600 hover:bg-blue-400 text-white' : 'bg-gray-200' }}"
                            wire:click='preciomax'>Precio Mayor</button>
                        <button type="button"
                            class="w-full p-1 text-left rounded-md border-0 btn {{ $filtro == 'PRECIO MAX' ? 'bg-blue-600 hover:bg-blue-400 text-white' : 'bg-gray-200' }}"
                            wire:click='preciomin'>Precio Menor</button>
                    </ul>
                </div>

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
                <tbody wire:loading.remove>
                    <!-- row 1 -->
                    @forelse ($datos as $dato)
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
                                <span
                                    class="inline-flex items-center px-2 py-1 text-sm font-medium text-blue-700 rounded-md bg-blue-50 ring-1 ring-inset ring-blue-700/10">
                                    {{ $dato['nm_producto'] }}
                                </span>
                            </td>
                            <td class="border">
                                <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['descripcion'] }}" disabled />
                            </td>
                            <td class="border">
                                <input type="text" class="w-auto bg-transparent border-none focus:outline-none"
                                    value="{{ $dato['categorias']['nombre'] }}" disabled />
                            </td>
                            <td class="w-10 text-center border ">
                                <span
                                    class="inline-flex items-center w-full px-2 py-1 font-semibold text-center text-green-700 rounded-md font-sm medium text- bg-green-50 ring-1 ring-inset ring-green-600/20">
                                    {{ $dato['precio'] }}
                                </span>
                            </td>
                            <td class="w-10 text-center border">
                                <span
                                    class="inline-flex items-center px-2 py-1 font-semibold text-center text-red-700 rounded-md font-sm medium text- bg-red-50 ring-1 ring-inset ring-red-600/10">
                                    {{ $dato['descuento'] ?? 0 }} %
                                </span>
                            </td>
                            <td class="w-10 border ">
                                <span
                                    class="inline-flex items-center px-2 py-1 font-semibold text-gray-600 rounded-md font-sm medium text- bg-gray-50 ring-1 ring-inset ring-gray-500/10">
                                    {{ $dato['stock'] }}
                                </span>
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
                                    <button wire:confirm="Estas seguro que desa eliminar este producto?"
                                        wire:click='eliminar({{ $dato['id'] }})'
                                        wire:confirm="Estas seguro que deseas eliminar este producto ?"
                                        class="px-5 py-3 text-red-500 bg-red-200 border border-red-500 badge"><i
                                            class="fa-solid fa-trash"></i></button>
                                </div>
                            </th>
                        </tr>
                    @empty
                        <tr>
                            <td class="border">
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="w-20 h-12 mask mask-squircle">
                                            <img src="data:image/jpeg;base64,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"
                                                alt="Imagen sin resultado" class="w-full" />
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td colspan="4 text-xl font-semibold">
                                <span
                                    class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 rounded-md bg-red-50 ring-1 ring-inset ring-red-600/10">
                                    No se encontraron productos.
                                </span>
                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

            <div wire:loading role="status"
                class="w-full p-4 space-y-4 border border-gray-200 divide-y divide-gray-200 rounded shadow animate-pulse md:p-6 ">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full  w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full "></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full  w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full  w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full "></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full  w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full  w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full "></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full  w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full  w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full "></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full  w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-300 rounded-full  w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full "></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full  w-12"></div>
                </div>
                <span class="sr-only">Loading...</span>
            </div>

        </div>
    @endif
</div>
<script>
    window.addEventListener('correcto', () => {
        document.getElementById('my_modal_3').close();
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
        document.getElementById('my_modal_3').close();
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
