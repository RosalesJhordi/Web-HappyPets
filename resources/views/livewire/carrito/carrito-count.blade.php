<div>
    <div class="drawer drawer-end">
        <input id="my-drawer-44" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Page content here -->
            <label for="my-drawer-44" class="cursor-pointer drawer-button">
                <div id="openDrawer"
                    class="flex items-center justify-center mr-4 text-gray-400 indicator hover:text-gray-500">
                    <span
                        class="z-0 flex items-center text-base font-semibold text-white justify-start-center indicator-item badge bg-rosa">
                        @if ($datos)
                            {{ count($datos) }}
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
            <label for="my-drawer-44" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="min-h-full p-4 bg-white w-80 md:w-96 menu text-base-content" style="z-index: 9999;">

                <div class="w-full mb-4 text-2xl">
                    <h1 class="w-full font-bold text-center text-morado-oscuro">Productos en el carrito</h1>
                </div>
                @if (Session::get('authToken'))
                    <div class="tabs">
                        <div class="flex ">
                            <ul
                                class="grid items-center justify-center min-w-full grid-cols-3 gap-2 transition-all duration-300 border-b border-gray-200">
                                <li class="w-full text-center">
                                    <a href="javascript:void(0)"
                                        class="flex  items-center justify-center px-1 py-1 font-medium text-center text-gray-500 border-b-2 border-transparent rounded-md hover:text-gray-800 active active:bg-[#8492a6] tablink whitespace-nowrap"
                                        data-tab="tabs-with-background-1" role="tab">Carrito
                                        <span class="w-5 h-5 text-white bg-purple-600 rounded-full">
                                            {{ count($datos) }}
                                        </span>
                                    </a>
                                </li>
                                <li class="w-full text-center">
                                    <a href="javascript:void(0)"
                                        class="flex  items-center justify-center px-1 py-1 font-medium text-center text-gray-500 border-b-2 border-transparent rounded-md hover:text-gray-800 active:bg-[#8492a6] tablink whitespace-nowrap"
                                        data-tab="tabs-with-background-2" role="tab">Pedidos
                                        <span class="w-5 h-5 text-white bg-purple-600 rounded-full">
                                            {{ count($datoPedidos) }}
                                        </span>
                                    </a>
                                </li>
                                <li class="w-full text-center">
                                    <a href="javascript:void(0)"
                                        class="flex  items-center justify-center px-1 py-1 font-medium text-center text-gray-500 border-b-2 border-transparent rounded-md hover:text-gray-800 active:bg-[#8492a6] tablink whitespace-nowrap"
                                        data-tab="tabs-with-background-3" role="tab">Boletas
                                        <span class="w-5 h-5 text-white bg-purple-600 rounded-full">
                                            {{ count($tickets) }}
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-5">
                            <div id="tabs-with-background-1" role="tabpanel"
                                aria-labelledby="tabs-with-background-item-1" class="tabcontent">
                                <div class="space-y-6">
                                    @if (!empty($datos))
                                        <ul role="list" class="px-1 -my-6 divide-y divide-gray-200">
                                            @foreach ($datos as $dato)
                                                <div class="flex items-start py-6">
                                                    <div
                                                        class="relative flex-shrink-0 w-24 h-24 overflow-hidden border border-gray-200 rounded-md">
                                                        <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $dato['imagen'] }}"
                                                            alt="imagen de producto"
                                                            class="object-cover object-center w-full h-full">
                                                    </div>

                                                    <div class="flex flex-col flex-1 ml-4">
                                                        <div>
                                                            <div
                                                                class="flex justify-between text-base font-medium text-gray-900">
                                                                <h3>
                                                                    <a href="#">{{ $dato['nombre'] }}</a>
                                                                </h3>
                                                                <p class="ml-4">S/. {{ $dato['importe'] }}</p>
                                                            </div>

                                                            <div
                                                                class="flex items-center justify-between w-full space-x-2">
                                                                <button class="px-3 py-1 text-white bg-red-500 rounded"
                                                                    wire:click="disminuir({{ $dato['id'] }}, {{ $dato['cantidad'] - 1 }}, {{ $dato['productoPrecio'] }})"
                                                                    {{ $dato['cantidad'] <= 1 ? 'disabled' : '' }}>
                                                                    -
                                                                </button>
                                                                <span
                                                                    class="text-lg font-medium">{{ $dato['cantidad'] }}</span>
                                                                <button
                                                                    class="px-3 py-1 text-white bg-green-500 rounded"
                                                                    wire:click="aumentar({{ $dato['id'] }}, {{ $dato['cantidad'] + 1 }}, {{ $dato['productoPrecio'] }})">
                                                                    +
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="flex items-center justify-between flex-1 mt-1 text-sm">
                                                            <p class="text-gray-500">{{ $dato['colores'] }}</p>
                                                            <div class="flex">
                                                                <button type="button"v wire:click='eliminar("{{ $dato['id']  }}")'
                                                                    class="font-medium text-indigo-600 hover:text-indigo-500">Eliminar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </ul>
                                        <div
                                            class="sticky bottom-0 z-50 px-4 py-6 mt-2 bg-white border-t border-gray-200 sm:px-6">
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                <p>Subtotal</p>
                                                <p>S/. {{ $importeTotal }}</p>
                                            </div>
                                            <p class="mt-0.5 text-sm text-gray-500">Envío e impuestos calculados al
                                                finalizar la compra.
                                            </p>
                                            <div class="flex items-center justify-center w-full mt-6">
                                                <button type="button" onclick="modal_pago.showModal()"
                                                    class="flex items-center justify-center px-6 py-3 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700">Confirmar
                                                    compra</button>
                                            </div>
                                            <div class="flex justify-center mt-6 text-sm text-center text-gray-500">
                                                <p>
                                                    o
                                                    <a href="{{ route('Productos') }}"
                                                        class="font-medium text-indigo-600 hover:text-indigo-500">
                                                        Continuar comprando
                                                        <span aria-hidden="true"> &rarr;</span>
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    @else
                                        <div
                                            class="flex flex-col items-center justify-center w-full h-full gap-4 mt-8 ">
                                            <img src="{{ asset('img/undraw_empty_cart_co35.svg') }}"
                                                alt="imagen carrito" class="w-96">
                                            <h1 class="text-3xl text-gray-400 ">0 productos en el carrito</h1>
                                            <a href="#" class="btn btn-primary">
                                                Agregar productos
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div id="tabs-with-background-2" class="hidden tabcontent" role="tabpanel"
                                aria-labelledby="tabs-with-background-item-2">
                                <div class="space-y-6">
                                    @if (!empty($datoPedidos))
                                        <ul role="list" class="px-1 -my-6 divide-y divide-gray-200">
                                            @foreach ($datoPedidos as $pedidos)
                                                <div class="flex items-start py-6 border-b border-gray-200">
                                                    <!-- Imagen del Producto -->
                                                    <div
                                                        class="relative flex-shrink-0 w-24 h-24 overflow-hidden border border-gray-200 rounded-md shadow-sm">
                                                        <img src="{{ 'https://api.happypetshco.com/ServidorProductos/' . $pedidos['producto']['imagen'] }}"
                                                            alt="imagen de producto"
                                                            class="object-cover object-center w-full h-full">
                                                    </div>

                                                    <div class="flex flex-col flex-1 ml-4">
                                                        <!-- Información del Producto -->
                                                        <div
                                                            class="flex justify-between text-base font-medium text-gray-900">
                                                            <h3 class="text-lg font-semibold text-blue-600">
                                                                <a
                                                                    href="#">{{ $pedidos['producto']['nm_producto'] }}</a>
                                                            </h3>
                                                            <p class="ml-4 text-xl font-bold text-green-600">S/.
                                                                {{ $pedidos['importe'] }}</p>
                                                        </div>

                                                        <!-- Estado y Tipo de Pago -->
                                                        <div
                                                            class="flex items-center justify-between mt-2 text-sm text-gray-600">
                                                            <!-- Color -->
                                                            <p class="text-sm text-gray-500">{{ $pedidos['color'] }}
                                                            </p>
                                                            <p>{{ $pedidos['cantidad'] }}</p>

                                                            <!-- Estado y Pagado (Con badges) -->
                                                            <div class="flex space-x-2">
                                                                <span
                                                                    class="text-xs px-2 py-1 rounded-full {{ $pedidos['estado'] === 'Pendiente' ? 'bg-yellow-500 text-white' : 'bg-green-500 text-white' }}">
                                                                    {{ $pedidos['estado'] }}
                                                                </span>
                                                                <span
                                                                    class="text-xs px-2 py-1 rounded-full {{ $pedidos['pagado'] === 'Sí' ? 'bg-blue-500 text-white' : 'bg-red-500 text-white' }}">
                                                                    {{ $pedidos['pagado'] }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <!-- Tipo de Pago -->
                                                        <div class="flex space-x-2">
                                                            <span
                                                                class="text-sm text-gray-700">{{ $pedidos['tipo_pago'] }}</span>
                                                            <span
                                                                class="text-blue-600">{{ $pedidos['codigo_operacion'] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div
                                            class="flex flex-col items-center justify-center w-full h-full gap-4 mt-8 ">
                                            <img src="{{ asset('img/undraw_empty_cart_co35.svg') }}"
                                                alt="imagen carrito" class="w-96">
                                            <h1 class="text-3xl text-gray-400 ">0 pedidos</h1>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div id="tabs-with-background-3" class="hidden tabcontent" role="tabpanel"
                                aria-labelledby="tabs-with-background-item-3">
                                <div class="space-y-6">
                                    @if (!empty($tickets))
                                        <ul role="list" class="px-1 mt-3 mb-3 -my-6 divide-y divide-gray-200">
                                            @foreach ($tickets as $ticket)
                                                <div
                                                    class="w-full max-w-md p-6 mt-2 text-white bg-purple-600 border-4 border-gray-300 shadow-xl rounded-3xl">
                                                    <div class="mb-6 text-center">
                                                        <h1 class="text-2xl font-bold">Ticket de Compra</h1>
                                                    </div>
                                                    <div
                                                        class="p-4 mb-4 text-black bg-white border-2 border-gray-300 rounded-3xl">
                                                        <div class="text-center">
                                                            <p class="text-4xl font-bold">S/ {{ $ticket['importe'] }}</p>
                                                            <p class="text-xl">{{ $ticket['usuario']['nombres'] }}</p>
                                                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($ticket['created_at'])->format('d/m/Y') }}
                                                            </p>
                                                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($ticket['created_at'])->format('h:i A') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="mb-4 text-center">
                                                        <p class="text-lg font-semibold">Detalle de la Compra</p>
                                                        <p class="text-sm">Código de Operación: {{ $ticket['codigo_operacion'] }}</p>
                                                        <p class="text-sm">DNI: {{ $ticket['usuario']['dni'] }}</p>
                                                        <p class="text-sm">Nombre del Cliente: {{ $ticket['usuario']['nombres'] }}</p>
                                                        <p class="text-sm">Monto Total: S/ {{ $ticket['importe'] }}</p>
                                                    </div>
                                                    {{-- <div class="flex justify-center"> <button
                                                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-700">
                                                            Descargar Recibo </button> </div> --}}
                                                </div>
                                            @endforeach
                                        </ul>
                                    @else
                                        <div
                                            class="flex flex-col items-center justify-center w-full h-full gap-4 mt-8 ">
                                            <img src="{{ asset('img/undraw_empty_cart_co35.svg') }}"
                                                alt="imagen carrito" class="w-96">
                                            <h1 class="text-3xl text-gray-400 ">Aún no realizó pedidos</h1>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center px-5 text-2xl" style="height: 80vh;">
                        <img src="{{ asset('img/undraw_empty_cart_co35.svg') }}" alt="Carr"
                            class="px-10 py-10 w-96">
                        Aun no tienes productos agregados, debes iniciar sesion para agregar productos
                        <a href="{{ route('Registro') }}" class="w-40 mt-5 text-xl btn btn-primary">Iniciar
                            sesion</a>
                    </div>
                @endif
            </ul>
        </div>
    </div>

    <dialog id="modal_pago" class="modal" wire:ignore.self>
        <div class="max-w-2xl rounded-sm modal-box">
            <div>
                <div class="mb-6 text-center">
                    <h1 class="text-xl font-semibold text-gray-700">Elije método de pago
                        <span class="px-2 py-1 ml-2 text-xs font-medium text-white bg-yellow-500 rounded-full">Estamos
                            Trabajando</span>
                    </h1>
                </div>

                <div class="py-4 text-center lg:px-4">
                    <div class="flex items-center p-2 leading-none text-black bg-yellow-500 lg:rounded-full lg:inline-flex"
                        role="alert">
                        <span
                            class="flex px-2 py-1 mr-3 text-xs font-bold text-black uppercase bg-white rounded-full">Aviso</span>
                        <span class="flex-auto mr-2 font-semibold text-left">Por el momento, únicamente está disponible
                            el método de pago en efectivo.</span>
                    </div>
                </div>

                <!-- Opciones de Métodos de Pago -->
                <div class="flex items-center justify-center w-full gap-4 py-3">
                    <!-- Opción de Pago 1 -->
                    <div wire:click="seleccionarMetodo('Efectivo')"
                        class="flex flex-col items-center justify-center w-1/3 p-4 transition transform border rounded-lg h-52 cursor-pointer {{ $metodoSeleccionado == 'Efectivo' ? 'border-blue-600 shadow-xl scale-105' : 'hover:border-blue-600 hover:shadow-lg hover:scale-105' }} bg-gray-50">
                        <img src="{{ asset('img/efectivo.jpg') }}" alt="Logo"
                            class="object-cover w-16 h-16 mb-3">
                        <span class="text-sm font-semibold text-gray-600">Pago con Efectivo</span>
                        <span
                            class="px-2 py-1 mt-2 text-xs font-medium text-white bg-green-500 rounded-full">Recomendado</span>
                    </div>

                    <!-- Opción de Pago 2 -->
                    <div
                        class="flex pointer-events: none; flex-col items-center justify-center w-1/3 p-4 transition transform border rounded-lg h-52 cursor-pointer {{ $metodoSeleccionado == 'Yape' ? 'border-blue-600 shadow-lg scale-105' : 'hover:border-blue-600 hover:shadow-lg hover:scale-105' }} bg-gray-50">
                        <img src="{{ asset('img/logo (1).png') }}" alt="Logo"
                            class="object-cover w-16 h-16 mb-3">
                        <span class="text-sm font-semibold text-gray-600">Pago con Yape</span>
                        <span
                            class="px-2 py-1 mt-2 text-xs font-medium text-white bg-indigo-600 rounded-full">Próximamente</span>
                    </div>

                    <!-- Opción de Pago 3 -->
                    <div
                        class="flex pointer-events: none; flex-col items-center justify-center w-1/3 p-4 transition transform border rounded-lg h-52 cursor-pointer {{ $metodoSeleccionado == 'Tarjeta' ? 'border-blue-600 shadow-lg scale-105' : 'hover:border-blue-600 hover:shadow-lg hover:scale-105' }} bg-gray-50">
                        <img src="{{ asset('img/targeta.jpg') }}" alt="Tarjeta"
                            class="object-cover w-16 h-16 mb-3">
                        <span class="text-sm font-semibold text-gray-600">Pago con Tarjeta</span>
                        <span
                            class="px-2 py-1 mt-2 text-xs font-medium text-white bg-indigo-500 rounded-full">Próximamente</span>
                    </div>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-lg">
                    <h2 class="text-4xl font-extrabold text-center text-gray-800">S/. {{ $importeTotal }}</h2>
                    <ul class="mt-6 space-y-4">
                        @if (!empty($datos))
                            @foreach ($datos as $dato)
                                <li class="flex items-center gap-4 pb-3 border-b">
                                    <span
                                        class="flex items-center justify-center w-8 h-8 text-xs font-bold text-blue-600 bg-blue-100 rounded-full">
                                        {{ $dato['cantidad'] }}
                                    </span>
                                    <span class="flex-1 text-sm text-gray-800">{{ $dato['nombre'] }}</span>
                                    <span class="font-semibold text-gray-800">S/. {{ $dato['importe'] }}</span>
                                </li>
                            @endforeach
                        @else
                            <li class="mt-4 text-center">
                                <a href="{{ route('Productos') }}"
                                    class="inline-block px-6 py-2 text-sm font-semibold text-white transition bg-blue-600 rounded-md shadow-sm hover:bg-blue-700">
                                    Agregar Productos
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

            </div>
            <div class="modal-action">
                <button class="btn btn-primary" wire:click='ConfirmarProductos'>Confirmar Productos</button>
                <form method="dialog">
                    <button class="text-white bg-red-500 btn">Cancelar</button>
                </form>
            </div>
        </div>
    </dialog>
</div>
<script>
    window.addEventListener('correcto', () => {
        document.getElementById('modal_pago').close();
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
        document.getElementById('modal_pago').close();
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
