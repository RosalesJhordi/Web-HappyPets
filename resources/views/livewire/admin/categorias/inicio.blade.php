<div class="w-full">
    <!-- Estilos y scripts de iziToast -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    <div class="flex w-full gap-5 py-5">
        @livewire('admin.secciones.categorias-count')
    </div>

    <div class="flex flex-wrap gap-2">
        <!-- Botones para abrir modales -->
        <button onclick="my_modal_31.showModal()"
            class="flex items-center justify-start w-full gap-2 px-2 py-2 text-gray-400 bg-white border rounded-sm shadow-md md:w-80">
            <span class="flex items-center justify-center w-10 h-10 text-xl text-green-600 bg-green-200 rounded-full">
                <i class="fa-solid fa-plus"></i>
            </span>
            <span>
                <h1 class="text-lg font-bold text-gray-400">Nueva Categoria</h1>
            </span>
        </button>
        <button onclick="my_modal_32.showModal()"
            class="flex items-center justify-start w-full gap-2 px-2 py-2 text-gray-400 bg-white border rounded-sm shadow-md md:w-80">
            <span class="flex items-center justify-center w-10 h-10 text-xl text-orange-600 bg-orange-200 rounded-full">
                <i class="fa-solid fa-plus"></i>
            </span>
            <span>
                <h1 class="text-lg font-bold text-gray-400">Nueva Sub-Categoria</h1>
            </span>
        </button>
        <button onclick="my_modal_33.showModal()"
            class="flex items-center justify-start w-full gap-2 px-2 py-2 text-gray-400 bg-white border rounded-sm shadow-md md:w-80">
            <span class="flex items-center justify-center w-10 h-10 text-xl text-blue-600 bg-blue-200 rounded-full">
                <i class="fa-solid fa-plus"></i>
            </span>
            <span>
                <h1 class="text-lg font-bold text-gray-400">Nueva Sub-Sub-Categoria</h1>
            </span>
        </button>

        <!-- Modal 1 - Nueva Categoria -->
        <dialog id="my_modal_31" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="absolute btn btn-xl btn-circle btn-ghost right-2 top-2">✕</button>
                </form>
                <h3 class="text-lg font-bold">Agregar nueva categoria</h3>
                <form class="flex flex-col items-center justify-center gap-2 px-5 py-5"
                    wire:submit.prevent="addCategoria" novalidate>
                    <!-- Mensajes de éxito y error -->
                    @if (session('mensaje'))
                        <div
                            class="flex items-center justify-center w-full gap-2 p-1 text-center text-green-600 bg-green-100 border border-green-600 rounded-sm">
                            <i class="fa-solid fa-check"></i>
                            <span>{{ session('mensaje') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div
                            class="flex items-center justify-center w-full gap-2 p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">
                            <i class="fa-solid fa-xmark"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif
                    <div class="flex flex-col items-center justify-center w-full h-full gap-2">
                        <div class="w-full col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre Categoria</label>
                            <input type="text" wire:model='nombreCategoria' name="nombre" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Juguetes, Accesorios, etc" required>
                        </div>
                        <button type="submit" class="w-full p-2 mt-5 text-white bg-purple-700 rounded hover:bg-purple-600">
                            Agregar Categoria
                        </button>
                    </div>
                </form>
            </div>
        </dialog>

        <!-- Modal 2 - Nueva Sub-Categoria -->
        <dialog id="my_modal_32" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="absolute btn btn-xl btn-circle btn-ghost right-2 top-2">✕</button>
                </form>
                <h3 class="text-lg font-bold">Agregar nueva sub-categoria</h3>
                <form class="flex flex-col items-center justify-center w-full gap-2 px-5 py-5"
                    wire:submit.prevent="addSubCategoria" novalidate>
                    <!-- Mensajes de éxito y error -->
                    @if (session('mensaje'))
                        <div
                            class="flex items-center justify-center w-full gap-2 p-1 text-center text-green-600 bg-green-100 border border-green-600 rounded-sm">
                            <i class="fa-solid fa-check"></i>
                            <span>{{ session('mensaje') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div
                            class="flex items-center justify-center w-full gap-2 p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">
                            <i class="fa-solid fa-xmark"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif
                    <div class="flex flex-col items-center justify-center w-full h-full gap-2">
                        <select id="categoria" wire:model="categorias_id" class="bg-gray-50 border cursor-pointer border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected>Selecciona Categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                            @endforeach
                        </select>
                        <div class="w-full col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre Sub-Categoria</label>
                            <input type="text" wire:model='nombreSubCategoria' name="nombre" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                        <button type="submit" class="w-full p-2 mt-5 text-white bg-purple-700 rounded hover:bg-purple-600">
                            Agregar Sub-Categoria
                        </button>
                    </div>
                </form>
            </div>
        </dialog>

        <!-- Modal 3 - Nueva Sub-Sub-Categoria -->
        <dialog id="my_modal_33" class="modal">
            <div class="modal-box">
                <form method="dialog">
                    <button class="absolute btn btn-xl btn-circle btn-ghost right-2 top-2">✕</button>
                </form>
                <h3 class="text-lg font-bold">Agregar nueva sub-sub-categoria</h3>
                <form class="flex flex-col items-center justify-center gap-2 px-5 py-5" wire:submit.prevent="addSubSubCategoria" novalidate>
                    @if (session('mensaje'))
                        <div class="flex items-center justify-center w-full gap-2 p-1 text-center text-green-600 bg-green-100 border border-green-600 rounded-sm">
                            <i class="fa-solid fa-check"></i>
                            <span>{{ session('mensaje') }}</span>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="flex items-center justify-center w-full gap-2 p-1 text-center text-red-600 bg-red-100 border border-red-600 rounded-sm">
                            <i class="fa-solid fa-xmark"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    @endif
                    <div class="flex flex-col items-center justify-center w-full h-full gap-2">
                        <select id="categoria" wire:model="sub_categorias_id" class="bg-gray-50 border cursor-pointer border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected>Selecciona Sub Categoria</option>
                            @foreach ($subcategorias as $categoriaa)
                                <option value="{{ $categoriaa['id'] }}">{{ $categoriaa['nombre'] }}</option>
                            @endforeach
                        </select>
                        <div class="w-full col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre Sub-Sub-Categoria</label>
                            <input type="text" wire:model='nombreSubSubCategoria' name="nombre" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                        <button type="submit" class="w-full p-2 mt-5 text-white bg-purple-700 rounded hover:bg-purple-600">
                            Agregar Sub-Sub-Categoria
                        </button>
                    </div>
                </form>
            </div>
        </dialog>
    </div>

    <div class="w-full max-w-xs">
        <h2 class="mb-4 text-2xl font-bold">Categorías</h2>

        <!-- Categorías principales -->
        <ul class="space-y-2">
            @foreach ($categoriaTree as $categoria)
                <li class="relative">
                    <!-- Botón de la categoría principal -->
                    <button
                        type="button"
                        class="flex items-center justify-between w-full px-4 py-2 text-left text-white bg-purple-700 rounded-lg hover:bg-purple-800 focus:outline-none"
                        onclick="toggleDropdown('dropdown-{{ $categoria['id'] }}')"
                    >
                        <span>{{ $categoria['nombre'] }}</span>
                        <!-- Mostrar el icono solo si tiene subcategorías -->
                        @if (!empty($categoria['subcategorias']))
                            <i id="icon-{{ $categoria['id'] }}" class="text-white fas fa-chevron-down"></i>
                        @endif
                    </button>

                    <!-- Subcategorías (si existen) -->
                    @if (!empty($categoria['subcategorias']))
                        <ul id="dropdown-{{ $categoria['id'] }}" class="hidden pl-6 mt-2 space-y-2">
                            @foreach ($categoria['subcategorias'] as $subcategoria)
                                <li class="relative">
                                    <!-- Botón de la subcategoría -->
                                    <button
                                        type="button"
                                        class="flex items-center justify-between w-full px-4 py-2 text-left text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none"
                                        onclick="toggleDropdown('dropdown-{{ $subcategoria['id'] }}')"
                                    >
                                        <span>{{ $subcategoria['nombre'] }}</span>
                                        <!-- Mostrar el icono solo si tiene sub-subcategorías -->
                                        @if (!empty($subcategoria['sub_sub_categorias']))
                                            <i id="icon-{{ $subcategoria['id'] }}" class="text-white fas fa-chevron-down"></i>
                                        @endif
                                    </button>

                                    <!-- Sub-subcategorías (si existen) -->
                                    @if (!empty($subcategoria['sub_sub_categorias']))
                                        <ul id="dropdown-{{ $subcategoria['id'] }}" class="hidden pl-6 mt-2 space-y-2">
                                            @foreach ($subcategoria['sub_sub_categorias'] as $subsubcategoria)
                                                <li class="px-4 py-1 text-gray-700 bg-gray-100 rounded-lg">
                                                    {{ $subsubcategoria['nombre'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <script>
        // Función para alternar el estado del dropdown y la rotación de la flecha
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            dropdown.classList.toggle('hidden');

            // Cambiar la dirección de la flecha
            const icon = document.getElementById('icon-' + id.split('-')[1]);
            if (icon) {
                icon.classList.toggle('rotate-180');
            }
        }
    </script>

    <!-- Incluye Font Awesome para los íconos -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>


</div>
<script>
    window.addEventListener('correcto', () => {
        document.getElementById('my_modal_31').close();
        document.getElementById('my_modal_32').close();
        document.getElementById('my_modal_33').close();
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
        console.log('gaaa');
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
