<div>
    <div class="drawer drawer-end">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->
            <label for="my-drawer-4" class="cursor-pointer drawer-button">
                <div id="openDrawer"
                    class="flex items-center justify-center mr-4 text-gray-400 indicator hover:text-gray-500">
                    <span wire:poll='datosCarrito'
                        class="z-0 flex items-center text-base font-semibold text-white justify-start-center indicator-item badge bg-rosa">
                        @if ($datos)
                            {{ count($datos)}}
                        @else
                            0
                        @endif
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                </div>
            </label>
        </div>
        <div class="drawer-side" style="z-index: 9999;">
            <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="min-h-full p-4 bg-white w-96 md:w-1/4 menu text-base-content" style="z-index: 9999;">

                <div class="w-full text-2xl">
                    <h1 class="w-full font-bold text-center text-morado-oscuro">Productos en el carrito</h1>
                </div>

                @if (Session::get('authToken'))
                    @if (!empty($datos))
                        <ul role="list" class="px-4 mt-8 -my-6 divide-y divide-gray-200">
                            @foreach ($datos as $dato)
                                <div class="flex items-start py-6">
                                    <div
                                        class="relative flex-shrink-0 w-24 h-24 overflow-hidden border border-gray-200 rounded-md">
                                        <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $dato['imagen'] }}"
                                            alt="imagen de producto" class="object-cover object-center w-full h-full">
                                        <div
                                            class="absolute inline-flex items-center justify-center w-6 h-6 px-4 py-4 text-lg font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -end-2 dark:border-gray-900">
                                            {{ $dato['cantidad'] }}
                                        </div>
                                    </div>

                                    <div class="flex flex-col flex-1 ml-4">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                <h3>
                                                    <a href="#">{{ $dato['nombre'] }}</a>
                                                </h3>
                                                <p class="ml-4">S/. {{ $dato['importe'] }}</p>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500">{{ $dato['categoria'] }}
                                            </p>
                                        </div>
                                        <div class="flex items-center justify-between flex-1 text-sm">
                                            <p class="text-gray-500">{{ $dato['colores'] }}</p>
                                            <div class="flex">
                                                <button type="button"
                                                    class="font-medium text-indigo-600 hover:text-indigo-500">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                        <div class="sticky bottom-0 z-50 px-4 py-6 bg-white border-t border-gray-200 sm:px-6">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Subtotal</p>
                                <p>S/. {{ $importeTotal }}</p>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-500">Envío e impuestos calculados al finalizar la compra.
                            </p>
                            <div class="mt-6">
                                <a href="#"
                                    class="flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700">Confirmar
                                    compra</a>
                            </div>
                            <div class="flex justify-center mt-6 text-sm text-center text-gray-500">
                                <p>
                                    o
                                    <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Continuar comprando
                                        <span aria-hidden="true"> &rarr;</span>
                                    </button>
                                </p>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center w-full h-full gap-4 mt-8 ">
                            <img src="{{ asset('img/undraw_empty_cart_co35.svg') }}" alt="imagen carrito"
                                class="w-96">
                            <h1 class="text-3xl text-gray-400 ">0 productos en el carrito</h1>
                            <a href="#" class="btn btn-primary">
                                Agregar productos
                            </a>
                        </div>
                    @endif
                @else
                    <div class="flex flex-col items-center justify-center px-5 text-2xl" style="height: 80vh;">
                        <img src="{{ asset('img/undraw_empty_cart_co35.svg') }}" alt="Carr"
                            class="px-10 py-10 w-96">
                        Aun no tienes productos agregados, debes iniciar sesion para agregar productos
                        <a href="{{ route('Registro') }}" class="w-40 py-4 mt-5 text-xl btn btn-primary">Iniciar
                            sesion</a>
                    </div>
                @endif
            </ul>
        </div>
    </div>
</div>
