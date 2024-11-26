<div class="w-full">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <div class="flex w-full gap-5 py-5">
        @livewire('admin.secciones.pedidos-count')
    </div>
    @if ($showdetalles && !empty($detalles))
        <button class="px-4 py-2 mb-4 font-semibold text-white bg-blue-600 rounded shadow hover:bg-blue-700"
            wire:click='$set("showdetalles",false)'>Atrás</button>
        @php
            $detallesAgrupados = collect($detalles)->groupBy('codigo_operacion');
        @endphp

        <div class="grid w-full grid-cols-1 gap-6 mt-2">
            @foreach ($detallesAgrupados as $codigoOperacion => $productos)
                <div class="p-6 bg-white border border-gray-300 rounded-sm shadow-xl">
                    <h4 class="py-3 mb-3 text-5xl font-bold text-center text-indigo-700 ">{{ $codigoOperacion }}</h4>
                    @if (!empty($productos[0]['usuario']))
                        <div class="mb-4 text-gray-700">
                            <p><strong>Cliente:</strong> {{ $productos[0]['usuario']['nombres'] }}
                                {{ $productos[0]['usuario']['apellidos'] }}</p>
                            <p><strong>Ubicación:</strong> {{ $productos[0]['usuario']['ubicacion'] }}</p>
                            <p><strong>Teléfono:</strong> {{ $productos[0]['usuario']['telefono'] }}</p>
                        </div>
                    @endif
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                        @php
                            $productosUnicos = $productos->reduce(function ($carry, $item) {
                                $key =
                                    $item['producto']['nm_producto'] .
                                    $item['color'] .
                                    $item['producto']['descripcion'];
                                if (!isset($carry[$key])) {
                                    $carry[$key] = $item;
                                } else {
                                    $carry[$key]['cantidad'] += $item['cantidad'];
                                    $carry[$key]['importe'] += $item['importe'];
                                }
                                return $carry;
                            }, []);
                        @endphp
                        @foreach ($productosUnicos as $producto)
                            @php
                                $precioOriginal = $producto['producto']['precio'];
                                $descuento = isset($producto['producto']['descuento'])
                                    ? $producto['producto']['descuento']
                                    : 0;
                                $precioConDescuento = $precioOriginal * (1 - $descuento / 100);
                            @endphp
                            <div class="p-5 bg-white border border-gray-200 rounded-md shadow-md">
                                <h5 class="mb-2 text-xl font-semibold text-gray-800">
                                    {{ $producto['producto']['nm_producto'] }}</h5>
                                <p class="text-sm text-gray-600"><strong>Descripción:</strong>
                                    {{ $producto['producto']['descripcion'] }}</p>
                                <p class="text-sm text-gray-600"><strong>Cantidad:</strong> {{ $producto['cantidad'] }}
                                </p>
                                <p class="text-sm text-gray-600"><strong>Color:</strong> {{ $producto['color'] }}</p>
                                <p class="text-sm text-gray-600"><strong>Precio Unitario:</strong> S/
                                    {{ number_format($precioConDescuento, 2) }} @if ($descuento > 0)
                                        <span
                                            class="px-2 py-1 ml-2 text-xs text-white bg-red-500 rounded-full">Descuento</span>
                                    @endif
                                </p>
                                <p class="text-sm text-gray-600"><strong>Importe Total:</strong> S/
                                    {{ number_format($producto['importe'], 2) }}</p>
                            </div>
                        @endforeach
                    </div>
                    <button wire:click='confirmarProductos("{{ $codigoOperacion }}")' class="mt-4 rounded-md btn btn-primary">Confirmar productos</button>
                </div>
            @endforeach
        </div>
    @else
        <div class="flex items-center w-full py-3 md:w-1/2">
            <input type="text" wire:model.live='buscado'
                class="w-full p-2 border border-gray-300 rounded-l-lg focus:outline-none focus:ring-0"
                placeholder="Buscar por codigo OP...">
            <button type="submit"
                class="p-2.5 text-white bg-blue-500 border border-blue-500 rounded-r-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
        </div>
        <div class="grid grid-cols-2 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
            @php
                $groupedData = collect($datos)->groupBy('codigo_operacion');
            @endphp
            @foreach ($groupedData as $codigo_operacion => $items)
                <div
                    class="relative p-5 transition-transform transform bg-white border border-gray-200 rounded-sm shadow-lg cursor-pointer hover:scale-105">
                    <h4 class="mb-2 text-2xl font-bold text-gray-900">{{ $codigo_operacion }}</h4>
                    <div class="mb-4 text-xl font-semibold text-gray-800">{{ 'S/.' . ' ' . $items->sum('importe') }}
                    </div>
                    <div class="flex flex-col mt-4 space-y-2">
                        <button type="button" wire:click="mostrarDetalles('{{ $codigo_operacion }}')"
                            class="flex items-center justify-center px-4 py-2 font-semibold text-white bg-blue-500 rounded-md shadow hover:bg-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                            Detalles
                        </button>
                        <button type="button" wire:click='confirmarProductos("{{ $codigo_operacion }}")'
                            class="flex items-center justify-center px-4 py-2 font-semibold text-white bg-green-500 rounded-md shadow hover:bg-green-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Confirmar
                        </button>
                    </div>
                </div>
            @endforeach
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
            transitionIn: 'bounce',
            zindex: 999999
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
            transitionIn: 'bounce',
            zindex: 999999
        });
    });
</script>
