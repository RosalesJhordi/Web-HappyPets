<div class="w-full bg-white">
    <div class="max-w-2xl px-4 py-5 mx-auto sm:px-6 sm:py-10 lg:max-w-7xl lg:px-8">
        <div>
            buscador
        </div>
        <div class="grid grid-cols-3 gap-2 sm:grid-cols-4 md:grid-cols-6">
            <button wire:click="cambiarFiltro('Todos')" type="button"
                class="text-white font-semibold {{ $filtro == 'Todos' ? 'bg-rosa text-white' : 'bg-blue-700' }} hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">
                Todos
            </button>

            <button wire:click="cambiarFiltro('Descuento')" type="button"
                class="text-white font-semibold {{ $filtro == 'Descuento' ? 'bg-rosa text-white' : 'bg-blue-700' }} hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">
                Descuento
            </button>
            @foreach ($categorias as $categoria)
                <button wire:click="cambiarFiltro('{{ $categoria }}')" type="button"
                    class="text-white font-semibold {{ $filtro == $categoria ? 'bg-rosa text-white' : 'bg-blue-700' }} hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">
                    {{ $categoria }}
                </button>
            @endforeach
        </div>
        <h2 class="py-3 text-2xl font-bold tracking-tight text-gray-500">{{ $filtro }}</h2>
        <div wire:loading.remove class="w-full">
            @if (!empty($datos))
                <div class="grid grid-cols-2 mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                    @foreach ($datos as $data => $producto)
                        <div class="flex flex-col border rounded-md ">
                            <div class="relative group">
                                <div
                                    class="w-full overflow-hidden bg-gray-200 rounded-md aspect-h-1 aspect-w-1 lg:aspect-none group-hover:opacity-75 lg:h-80">
                                    <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $producto['imagen'] }}"
                                        alt="Front of men&#039;s Basic Tee in black."
                                        class="object-cover object-center w-full h-80 lg:h-full lg:w-full">
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
                                        <p class="mt-1 text-sm text-gray-500">{{ $producto['categorias_id'] }}</p>
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

                                <button onclick="document.getElementById('my_modal_{{ $producto['id'] }}').showModal()"
                                    class="w-full px-2 py-2 text-white cursor-pointer btn btn-primary">
                                    Agregar a carrito
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </button>

                                <dialog id="my_modal_{{ $producto['id'] }}" class="modal">
                                    <div class="w-11/12 max-w-5xl modal-box">
                                        <form method="dialog">
                                            <button
                                                class="absolute z-50 btn btn-lg btn-circle btn-ghost right-1 top-1">✕</button>
                                        </form>
                                        @livewire('carrito.add-car', [$producto['nm_producto'], $producto['imagen'], $producto['id'], $producto['descuento'], $producto['precio'], $producto['descripcion'], $producto['colores']], key($producto['id']))
                                    </div>
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

        <div wire:loading class="flex items-center justify-center w-full">
            <div class="flex items-center justify-center w-full border border-gray-200 rounded-lg h-96 bg-gray-50 ">
                <div
                    class="px-5 py-3 text-2xl font-medium leading-none text-center text-white rounded-full bg-rosa animate-pulse ">
                    Cargando...</div>
            </div>
        </div>
    </div>
</div>
