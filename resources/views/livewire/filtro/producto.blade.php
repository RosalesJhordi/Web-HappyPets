<div class="flex flex-col justify-between w-full px-1 md:flex-row red-500 xl:max-w-6xl">

    <div class="hidden md:flex overflow-y-auto py-2 sm:py-10 flex-col w-full h-[90vh] md:w-[20%]"
        style="scrollbar-width: none; -ms-overflow-style: none;">
        <div class="max-w-xs p-6 mt-3 bg-white border border-gray-200 rounded-lg shadow-sm">

            <div class="mb-6">
                <h3 class="mb-3 text-lg font-semibold text-gray-800">Filtro</h3>
                <div class="flex flex-col space-y-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="filtro" wire:model.live="filtro" value="Todos"
                            class="text-blue-600 rounded form-radio" />
                        <span class="ml-2 text-gray-700">Todos</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" name="filtro" wire:model.live="filtro" value="Descuento"
                            class="text-blue-600 rounded form-radio" />
                        <span class="ml-2 text-gray-700">Descuentos</span>
                    </label>
                </div>
            </div>
            <!-- Divider -->
            <hr class="my-4 border-gray-300">

            <!-- Filtro de Colores -->
            <div class="mb-6">
                <h3 class="mb-3 text-lg font-semibold text-gray-800">Color</h3>
                <div class="flex flex-col space-y-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model.live="colores" value="Blanco"
                            class="text-blue-600 rounded form-checkbox" />
                        <span class="ml-2 text-gray-700">Blanco</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model.live="colores" value="Rojo"
                            class="text-blue-600 rounded form-checkbox" />
                        <span class="ml-2 text-gray-700">Rojo</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model.live="colores" value="Azul"
                            class="text-blue-600 rounded form-checkbox" />
                        <span class="ml-2 text-gray-700">Azul</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model.live="colores" value="Verde"
                            class="text-blue-600 rounded form-checkbox" />
                        <span class="ml-2 text-gray-700">Verde</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model.live="colores" value="Amarillo"
                            class="text-blue-600 rounded form-checkbox" />
                        <span class="ml-2 text-gray-700">Amarillo</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="checkbox" wire:model.live="colores" value="Negro"
                            class="text-blue-600 rounded form-checkbox" />
                        <span class="ml-2 text-gray-700">Negro</span>
                    </label>
                </div>
            </div>

            <!-- Divider -->
            <hr class="my-4 border-gray-300">

            <!-- Filtro de Categoría -->
            <div class="mb-6">
                <h3 class="mb-4 text-xl font-semibold text-gray-800">Categorías</h3>
                <div class="space-y-2">
                    @forelse ($categorias as $categoria)
                        <div>
                            <label class="flex items-center justify-between cursor-pointer">
                                <div class="flex items-center">
                                    <input type="checkbox" class="mr-2 text-blue-600 rounded form-checkbox"
                                        wire:model.live="filtroCategorias" value="{{ $categoria['nombre'] }}" />
                                    <span class="text-gray-700 ">{{ $categoria['nombre'] }}</span>
                                </div>
                            </label>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">No hay categorías disponibles.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    <div class="px-4 overflow-y-auto py-2 mx-auto sm:px-6 sm:py-10 w-full md:w-[80%] lg:px-8"
        style="scrollbar-width: none; -ms-overflow-style: none;">
        <div class="flex items-center justify-between w-full ">
            <h2 class="text-2xl font-bold tracking-tight text-gray-500">{{ $filtro }}</h2>
            <div class="w-auto drawer md:hidden">
                <input id="my-drawer" type="checkbox" class="drawer-toggle" />
                <div class=" drawer-content">
                    <!-- Page content here -->
                    <label for="my-drawer" class="btn drawer-button"><svg
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                        </svg>
                    </label>
                </div>
                <div class="drawer-side z-[9999]">
                    <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                    <ul class="min-h-full p-4 menu bg-base-200 text-base-content w-80">
                        <div class="flex-col w-full py-2 overflow-y-auto md:hidden sm:py-10"
                            style="scrollbar-width: none; -ms-overflow-style: none;">
                            <h1 class="text-xl font-semibold tracking-tight text-gray-500">Filtrar</h1>

                            <div class="relative mt-2">
                                <input type="search" id="default-search" wire:model.live='buscado'
                                    class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Buscar Producto..." />
                                <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="max-w-xs p-6 mt-3 bg-white border border-gray-200 rounded-lg shadow-sm">

                                <div class="mb-6">
                                    <h3 class="mb-3 text-lg font-semibold text-gray-800">Filtro</h3>
                                    <div class="flex flex-col space-y-2">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="filtro2" wire:model.live="filtro"
                                                value="Todos" class="text-blue-600 rounded form-radio" />
                                            <span class="ml-2 text-gray-700">Todos</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="filtro2" wire:model.live="filtro"
                                                value="Descuento" class="text-blue-600 rounded form-radio" />
                                            <span class="ml-2 text-gray-700">Descuentos</span>
                                        </label>
                                    </div>
                                </div>
                                <!-- Divider -->
                                <hr class="my-4 border-gray-300">

                                <!-- Filtro de Colores -->
                                <div class="mb-6">
                                    <h3 class="mb-3 text-lg font-semibold text-gray-800">Color</h3>
                                    <div class="flex flex-col space-y-2">
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" wire:model.live="colores" value="Blanco"
                                                class="text-blue-600 rounded form-checkbox" />
                                            <span class="ml-2 text-gray-700">Blanco</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" wire:model.live="colores" value="Rojo"
                                                class="text-blue-600 rounded form-checkbox" />
                                            <span class="ml-2 text-gray-700">Rojo</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" wire:model.live="colores" value="Azul"
                                                class="text-blue-600 rounded form-checkbox" />
                                            <span class="ml-2 text-gray-700">Azul</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" wire:model.live="colores" value="Verde"
                                                class="text-blue-600 rounded form-checkbox" />
                                            <span class="ml-2 text-gray-700">Verde</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" wire:model.live="colores" value="Amarillo"
                                                class="text-blue-600 rounded form-checkbox" />
                                            <span class="ml-2 text-gray-700">Amarillo</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" wire:model.live="colores" value="Negro"
                                                class="text-blue-600 rounded form-checkbox" />
                                            <span class="ml-2 text-gray-700">Negro</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Divider -->
                                <hr class="my-4 border-gray-300">

                                <!-- Filtro de Categoría -->
                                <div class="mb-6">
                                    <h3 class="mb-4 text-xl font-semibold text-gray-800">Categorías</h3>
                                    <div class="space-y-2">
                                        @forelse ($categorias as $categoria)
                                            <div>
                                                <label class="flex items-center justify-between cursor-pointer">
                                                    <div class="flex items-center">
                                                        <input type="checkbox"
                                                            class="mr-2 text-blue-600 rounded form-checkbox"
                                                            wire:model.live="filtroCategorias"
                                                            value="{{ $categoria['nombre'] }}" />
                                                        <span class="text-gray-700 ">{{ $categoria['nombre'] }}</span>
                                                    </div>
                                                </label>
                                            </div>
                                        @empty
                                            <p class="text-sm text-gray-500">No hay categorías disponibles.</p>
                                        @endforelse
                                    </div>
                                </div>

                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div wire:loading.remove class="w-full">
            @if (!empty($datos))
                <div class="grid grid-cols-2 mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
                    @foreach ($datos as $data => $producto)
                        <div class="flex flex-col border rounded-md "
                            wire:key="producto-{{ $loop->index }}-{{ $producto['id'] }}">
                            <div class="relative cursor-pointer group"
                                onclick="document.getElementById('my_modal_{{ $producto['id'] }}').showModal()">
                                <div
                                    class="w-full overflow-hidden bg-gray-200 rounded-md aspect-h-1 aspect-w-1 lg:aspect-none group-hover:opacity-75 lg:h-60">
                                    <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $producto['imagen'] }}"
                                        alt="Front of men&#039;s Basic Tee in black."
                                        class="object-cover object-center w-full h-60 xl:h-60 lg:h-full lg:w-full">
                                    @if ($producto['descuento'])
                                        <div
                                            class="absolute top-0 left-0 z-20 flex items-center justify-center w-16 h-8 p-2 text-center text-white bg-red-500">
                                            -{{ $producto['descuento'] }}%
                                        </div>
                                    @endif
                                </div>
                                <div class="flex justify-between px-2 py-2 mt-4">
                                    <div>
                                        <h3 class="text-sm text-gray-700">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{ $producto['nm_producto'] }}
                                        </h3>
                                        <p class="mt-1 text-sm text-gray-500">{{ $producto['categorias']['nombre'] }}
                                        </p>
                                    </div>
                                    @if ($producto['descuento'])
                                        <div class="flex flex-col">
                                            <p class="text-sm font-semibold text-green-600">
                                                S/.
                                                {{ number_format($producto['precio'] - ($producto['precio'] * $producto['descuento']) / 100, 2) }}
                                            </p>
                                            <p class="text-sm font-semibold text-red-600 line-through ">S/.
                                                {{ $producto['precio'] }}</p>
                                        </div>
                                    @else
                                        <p class="text-sm font-semibold text-gray-900">S/. {{ $producto['precio'] }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="z-30 px-2 py-2">

                                <button
                                    onclick="document.getElementById('my_modal_{{ $producto['id'] }}').showModal()"
                                    class="w-full px-2 py-2 text-white cursor-pointer btn btn-primary">
                                    Agregar a carrito
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </button>

                                <dialog wire:key="producto-{{ $loop->index }}-{{ $producto['id'] }}"
                                    id="my_modal_{{ $producto['id'] }}" class="modal">
                                    @livewire('carrito.add-car', [$producto['nm_producto'], $producto['imagen'], $producto['id'], $producto['descuento'], $producto['precio'], $producto['descripcion'], $producto['colores'], $producto['stock']], key('carrito-' . $loop->index . '-' . $producto['id']))
                                </dialog>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="w-full py-2">
                    <img src="{{ asset('img/undraw_taken_re_yn20.svg') }}" alt=""
                        class="object-fill w-full h-96">
                    <h1 class="py-3 text-xl text-center text-gray-600">NO SE ENCONTRARON PRODUCTOS DE ESTA CATEGORIA
                    </h1>
                </div>
            @endif
        </div>

        <div wire:loading class="flex items-center justify-center w-full h-full">
            <div class="flex items-center justify-center w-full h-full border border-gray-200 rounded-lg bg-gray-50 ">
                <div
                    class="px-5 py-3 text-2xl font-medium leading-none text-center text-white rounded-full bg-rosa animate-pulse ">
                    Cargando...</div>
            </div>
        </div>
    </div>
</div>
