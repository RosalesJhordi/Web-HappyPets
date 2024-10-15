<div class="w-full bg-white">
    <div class="max-w-2xl px-4 py-5 mx-auto sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-500">Productos nuevos</h2>
        @if (!empty($datos))
            <div wire:poll='obtenerdatos' class="grid grid-cols-1 mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                @foreach ($datos as $data)
                    <div class="relative border rounded-md group">
                        <div
                            class="w-full overflow-hidden bg-gray-200 rounded-md aspect-h-1 aspect-w-1 lg:aspect-none group-hover:opacity-75 lg:h-80">
                            <img src="{{ 'https://api-happypetshco-com.preview-domain.com/ServidorProductos/' . $data['imagen'] }}"
                                alt="Front of men&#039;s Basic Tee in black."
                                class="object-cover object-center w-full h-full lg:h-full lg:w-full">
                        </div>
                        <div class="flex justify-between px-2 py-2 mt-4">
                            <div>
                                <h3 class="text-sm text-gray-700">
                                    <span aria-hidden="true" class="absolute inset-0"></span>
                                    {{ $data['nm_producto'] }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ $data['categoria'] }}</p>
                            </div>
                            <p class="text-sm font-medium text-gray-900">S/. {{ $data['precio'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="flex items-center justify-end w-full py-2 mt-2">
                <button class="flex items-center justify-between p-2 px-5 text-xl font-semibold btn btn-primary">
                    Ver mas productos
                </button>
            </div>
        @else
            <div>
                <h1>Productos no encontrados</h1>
            </div>
        @endif
    </div>
</div>
