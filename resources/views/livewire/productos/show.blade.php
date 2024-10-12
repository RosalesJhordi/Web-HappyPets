<div class="w-full h-screen flex relative">
    @if ($producto)
        <!-- Sección del producto seleccionado -->
        <div class="w-3/4 h-full flex justify-center items-center p-8 animate-fade-in">
            <div wire:loading.remove
                class="card border bg-white shadow-lg rounded-lg overflow-hidden w-3/5 transform transition duration-500 hover:scale-105">
                <figure class="overflow-hidden">
                    <img src="{{ 'https://api-happypetshco-com.preview-domain.com/ServidorProductos/' . $producto['imagen'] }}"
                        alt="Imagen producto {{ $producto['nm_producto'] }}"
                        class="w-full h-auto object-cover transition duration-500 ease-in-out transform hover:scale-110"
                        style="height: 50vh;" />
                </figure>
                <div class="p-6">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $producto['nm_producto'] }}</h2>
                    <p class="text-gray-600 mb-4">{{ $producto['descripcion'] }}</p>
                    <p class="text-gray-500 mb-4">{{ $producto['categoria'] }}</p>
                    <div class="flex justify-end">
                        <button onclick="my_modal_3.showModal()"
                            class="px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition duration-300 ease-in-out">
                            Añadir a Carrito
                        </button>

                        <dialog id="my_modal_3" class="modal">
                            <div class="modal-box">
                                <form method="dialog">
                                    <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
                                </form>
                                @livewire('carrito.add-car',[$producto['nm_producto'],$producto['id'],$producto['precio']], key($producto['id']))
                            </div>
                        </dialog>
                    </div>
                </div>
            </div>
            <div wire:loading class="skeleton w-3/5 h-3/4"></div>
        </div>
    @endif

    <!-- Barra lateral con lista de productos -->
    <aside class="w-1/4 h-full bg-white border-l shadow-md overflow-y-auto animate-slide-in-right">
        <h2 class="font-bold text-2xl text-gray-700 p-5 border-b bg-white">Más productos</h2>
        <div class="flex justify-center items-center gap-2 border-b w-full py-2 px-4">
            <label class="input input-bordered flex items-center gap-2 p-1  w-full">
                <input type="text" wire:model.live="buscado" class="grow p-1" placeholder="Buscar por nombre" />
                <i class="fa-solid fa-magnifying-glass text-xl px-2 text-gray-400"></i>
            </label>
            <details class="dropdown">
                <summary class="btn m-1">
                    <i class="fa-solid fa-arrow-up-short-wide"></i>
                </summary>
                <ul
                    class="menu dropdown-content bg-blue-600 rounded-box z-[1] right-0 absolute w-52 p-2 shadow gap-2">
                    <button type="button" class="p-1 rounded-md btn" wire:click="showAll">Mostrar Todo</button>
                    <button type="button" class="p-1 rounded-md btn" wire:click="az">Accesorios</button>
                    <button type="button" class="p-1 rounded-md btn" wire:click="za">Comida</button>
                </ul>
            </details>
        </div>
        <div wire:loading.remove class="divide-y w-full divide-gray-200">
            @foreach ($productos as $serv)
                <button type="button" wire:click='mostrar({{ $serv['id'] }})'
                    class="flex table-zebra w-full items-center justify-between px-4 py-4 hover:bg-blue-300 transition-colors border-b 
                {{ $serv['id'] == $id_producto ? 'bg-blue-600 text-white' : '' }}">
                    <img src="{{ 'https://api-happypetshco-com.preview-domain.com/ServidorProductos/' . $serv['imagen'] }}"
                        alt="Imagen producto {{ $serv['nm_producto'] }}"
                        class="w-16 h-16 rounded-md object-cover mr-4" />
                    <div class="text-left flex-grow">
                        <h3 class="text-lg font-semibold">{{ $serv['nm_producto'] }}</h3>
                        <p class="text-sm {{ $serv['id'] == $id_producto ? 'text-gray-100' : 'text-gray-500' }}">
                            {{ $serv['descripcion'] }}</p>
                    </div>
                </button>
            @endforeach
        </div>
        <div wire:loading class="divide-y w-full flex justify-center items-center h-full mt-2">
            <span class="loading loading-ring loading-lg px-5 py-5">Cargando...</span>
        </div>
    </aside>

    <!-- CSS for animations -->
    <style>
        /* Animación para fade in */
        .animate-fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        /* Animación para slide in desde la derecha */
        .animate-slide-in-right {
            animation: slideInRight 0.7s ease-in-out;
        }

        @keyframes slideInRight {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(0);
            }
        }
    </style>
</div>
