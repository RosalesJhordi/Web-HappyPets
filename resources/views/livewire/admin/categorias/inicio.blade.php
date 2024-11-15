<div class="w-full">
    <!-- Estilos y scripts de iziToast -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    <div class="flex w-full gap-5 py-5">
        @livewire('admin.secciones.categorias-count')
    </div>

    <div class="flex flex-wrap gap-3">

        <!-- Botón Nueva Categoria -->
        <button onclick="my_modal_31.showModal()"
            class="flex items-center justify-between w-full px-4 py-2 text-left transition-transform transform bg-white border border-green-200 rounded-lg shadow-md hover:scale-105 hover:shadow-lg hover:bg-green-50 md:w-80">
            <div class="flex items-center gap-2">
                <span
                    class="flex items-center justify-center w-10 h-10 text-xl text-green-600 bg-green-200 rounded-full">
                    <i class="fa-solid fa-plus"></i>
                </span>
            </div>
            <span class="px-3 py-1 text-xs text-green-600 bg-green-100 rounded-full">Nueva Categoria</span>
        </button>

        <!-- Botón Nueva Sub-Categoria -->
        <button onclick="my_modal_32.showModal()"
            class="flex items-center justify-between w-full px-4 py-2 text-left transition-transform transform bg-white border border-orange-200 rounded-lg shadow-md hover:scale-105 hover:shadow-lg hover:bg-orange-50 md:w-80">
            <div class="flex items-center gap-2">
                <span
                    class="flex items-center justify-center w-10 h-10 text-xl text-orange-600 bg-orange-200 rounded-full">
                    <i class="fa-solid fa-plus"></i>
                </span>
            </div>
            <span class="px-3 py-1 text-xs text-orange-600 bg-orange-100 rounded-full">Nueva Sub-Categoria</span>
        </button>

        <!-- Botón Nueva Sub-Sub-Categoria -->
        <button onclick="my_modal_33.showModal()"
            class="flex items-center justify-between w-full px-4 py-2 text-left transition-transform transform bg-white border border-blue-200 rounded-lg shadow-md hover:scale-105 hover:shadow-lg hover:bg-blue-50 md:w-80">
            <div class="flex items-center gap-2">
                <span class="flex items-center justify-center w-10 h-10 text-xl text-blue-600 bg-blue-200 rounded-full">
                    <i class="fa-solid fa-plus"></i>
                </span>
            </div>
            <span class="px-3 py-1 text-xs text-blue-600 bg-blue-100 rounded-full">Nueva Sub-Sub-Categoria</span>
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
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre
                                Categoria</label>
                            <input type="text" wire:model='nombreCategoria' name="nombre" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="Juguetes, Accesorios, etc" required>
                        </div>
                        <button type="submit"
                            class="w-full p-2 mt-5 text-white bg-purple-700 rounded hover:bg-purple-600">
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
                        <select id="categoria" wire:model="categorias_id"
                            class="bg-gray-50 border cursor-pointer border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected>Selecciona Categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria['id'] }}">{{ $categoria['nombre'] }}</option>
                            @endforeach
                        </select>
                        <div class="w-full col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre
                                Sub-Categoria</label>
                            <input type="text" wire:model='nombreSubCategoria' name="nombre" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                        <button type="submit"
                            class="w-full p-2 mt-5 text-white bg-purple-700 rounded hover:bg-purple-600">
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
                <form class="flex flex-col items-center justify-center gap-2 px-5 py-5"
                    wire:submit.prevent="addSubSubCategoria" novalidate>

                    <div class="flex flex-col items-center justify-center w-full h-full gap-2">
                        <select id="categoria" wire:model="sub_categorias_id"
                            class="bg-gray-50 border cursor-pointer border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected>Selecciona Sub Categoria</option>
                            @foreach ($subcategorias as $categoriaa)
                                <option value="{{ $categoriaa['id'] }}">{{ $categoriaa['nombre'] }} - {{$categoriaa['categoria']['nombre']}}</option>
                            @endforeach
                        </select>
                        <div class="w-full col-span-2">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nombre
                                Sub-Sub-Categoria</label>
                            <input type="text" wire:model='nombreSubSubCategoria' name="nombre" id="nombre"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                required>
                        </div>
                        <button type="submit"
                            class="w-full p-2 mt-5 text-white bg-purple-700 rounded hover:bg-purple-600">
                            Agregar Sub-Sub-Categoria
                        </button>
                    </div>
                </form>
            </div>
        </dialog>

    </div>

    <div class="flex items-center justify-center w-full py-8">
        <div class="w-full px-4">
            <h2 class="mb-6 text-3xl font-semibold text-gray-800">Categorías</h2>

            <!-- Categorías principales -->
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3 xl:grid-cols-6">
                @foreach ($categoriaTree as $categoria)
                    <div
                        class="relative p-6 transition-all duration-500 transform bg-white rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 hover:shadow-xl">

                        <button type="button"
                            class="flex items-center justify-between w-full px-4 py-3 text-left text-white transition-all duration-300 bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500"
                            onclick="toggleDropdown('dropdown-main-{{ $categoria['id'] }}')">
                            <span class="text-xl font-medium">{{ $categoria['nombre'] }}</span>

                            @if (!empty($categoria['subcategorias']))
                                <i id="icon-main-{{ $categoria['id'] }}"
                                    class="text-white transition-transform duration-300 fas fa-chevron-down"></i>
                            @endif
                        </button>

                        <!-- Subcategorías (si existen) -->
                        @if (!empty($categoria['subcategorias']))
                            <div id="dropdown-main-{{ $categoria['id'] }}"
                                class="hidden mt-4 space-y-4 overflow-hidden transition-all duration-500 origin-top transform scale-y-0">
                                @foreach ($categoria['subcategorias'] as $subcategoria)
                                    <div
                                        class="relative p-6 transition-all duration-500 transform bg-blue-100 rounded-lg shadow-md hover:shadow-2xl hover:scale-105 hover:shadow-xl">

                                        <button type="button"
                                            class="flex items-center justify-between w-full px-4 py-2 text-left text-white transition-all duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            onclick="toggleDropdown('dropdown-sub-{{ $subcategoria['id'] }}')">
                                            <span class="text-lg font-medium">{{ $subcategoria['nombre'] }}</span>

                                            @if (!empty($subcategoria['sub_sub_categorias']))
                                                <i id="icon-sub-{{ $subcategoria['id'] }}"
                                                    class="text-white transition-transform duration-300 fas fa-chevron-down"></i>
                                            @endif
                                        </button>


                                        @if (!empty($subcategoria['sub_sub_categorias']))
                                            <div id="dropdown-sub-{{ $subcategoria['id'] }}"
                                                class="hidden mt-4 space-y-4 overflow-hidden transition-all duration-500 origin-top transform scale-y-0">
                                                @foreach ($subcategoria['sub_sub_categorias'] as $subsubcategoria)
                                                    <div
                                                        class="p-4 transition-all duration-300 transform bg-gray-200 rounded-lg shadow-sm hover:shadow-md hover:scale-105">
                                                        {{ $subsubcategoria['nombre'] }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            if (dropdown) {
                dropdown.classList.toggle('hidden');
                dropdown.classList.toggle('scale-y-100');
            }

            const iconId = 'icon-' + id.split('-')[1] + '-' + id.split('-')[2];
            const icon = document.getElementById(iconId);
            if (icon) {
                icon.classList.toggle('rotate-180');
            }
        }
    </script>

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <div class="container p-6 mx-auto mt-10 bg-white rounded-lg shadow-lg">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-800">Categorías y Subcategorías</h2>
        @if ($editarCategoria)
            <p class="py-2 text-lg font-semibold">Editar Categoría</p>
            <div class="flex items-center mb-4 space-x-3">

                <div class="flex items-center space-x-2">
                    <!-- Input para editar la categoría -->
                    <input type="text"
                        class="p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500"
                        placeholder="Nuevo Nombre..." wire:model.live="NuevaCategoria" />
                    <!-- Botón para guardar cambios -->
                    <button type="button"
                        class="p-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        wire:click="guardarCategoria">
                        Guardar cambios
                    </button>
                    <!-- Botón de cerrar -->
                    <button type="button"
                        class="p-2 text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                        wire:click="$set('editarCategoria', false)">
                        Cancelar
                    </button>
                </div>
            </div>
        @elseif ($editarSubCategoria)
            <p class="py-2 text-lg font-semibold">Editar Sub-Categoría</p>
            <div class="flex items-center mb-4 space-x-3">

                <div class="flex items-center space-x-2">
                    <!-- Input para editar la categoría -->
                    <input type="text"
                        class="p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500"
                        placeholder="Nuevo Nombre..." wire:model.live="NuevaSubCategoria" />
                    <!-- Botón para guardar cambios -->
                    <button type="button"
                        class="p-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        wire:click="guardarSubCategoria">
                        Guardar cambios
                    </button>
                    <!-- Botón de cerrar -->
                    <button type="button"
                        class="p-2 text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                        wire:click="$set('editarSubCategoria', false)">
                        Cancelar
                    </button>
                </div>
            </div>
        @elseif ($editarSubSubCategoria)
            <p class="py-2 text-lg font-semibold">Editar Sub-Sub-Categoría</p>
            <div class="flex items-center mb-4 space-x-3">

                <div class="flex items-center space-x-2">
                    <!-- Input para editar la categoría -->
                    <input type="text"
                        class="p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500"
                        placeholder="Nuevo Nombre..." wire:model.live="NuevaSubSubCategoria" />
                    <!-- Botón para guardar cambios -->
                    <button type="button"
                        class="p-2 text-white bg-blue-500 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                        wire:click="guardarSubSubCategoria">
                        Guardar cambios
                    </button>
                    <!-- Botón de cerrar -->
                    <button type="button"
                        class="p-2 text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                        wire:click="$set('editarSubSubCategoria', false)">
                        Cancelar
                    </button>
                </div>
            </div>
        @endif


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
                    <div class="w-32 h-2 bg-gray-200 rounded-full"></div>
                </div>
                <div class="h-2.5 bg-gray-300 rounded-full  w-12"></div>
            </div>
            <span class="sr-only">Loading...</span>
        </div>

        <table wire:loading.remove class="w-full border border-collapse border-gray-300">
            <thead>
                <tr class="text-white bg-blue-600">
                    <th class="p-3 text-left">Categoría</th>
                    <th class="p-3 text-left">Nivel</th>
                    <th class="p-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categoriaTree as $categoria)
                    <tr>
                        <td class="p-3 border-b border-gray-300">
                            <button onclick="toggleDropdown('dropdown-{{ $categoria['id'] }}')"
                                class="flex items-center w-full font-semibold text-left text-blue-600">
                                <span>{{ $categoria['nombre'] }}</span>
                                @if (!empty($categoria['subcategorias']))
                                    <i id="icon-{{ $categoria['id'] }}"
                                        class="ml-2 transition-transform duration-300 fas fa-chevron-down"></i>
                                @endif
                            </button>
                        </td>
                        <td class="p-3 border-b border-gray-300">Categoría Principal</td>
                        <td class="flex items-center p-3 space-x-2 border-b border-gray-300">
                            @if (!empty($categoria['subcategorias']))
                                <!-- Botón Editar con Badge -->
                                <button type="button" wire:click='editCategoria({{ $categoria['id'] }})'
                                    class="flex items-center text-green-600 hover:text-green-800">
                                    <i class="fas fa-edit"></i>
                                    <span
                                        class="ml-1 bg-green-100 text-green-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Editar</span>
                                </button>
                            @else
                                <button type="button" wire:click='editCategoria({{ $categoria['id'] }})'
                                    class="flex items-center text-green-600 hover:text-green-800">
                                    <i class="fas fa-edit"></i>
                                    <span
                                        class="ml-1 bg-green-100 text-green-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Editar</span>
                                </button>
                                <button type="button" wire:click='eliminarCategoria({{ $categoria['id'] }})'
                                    class="flex items-center text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash-alt"></i>
                                    <span
                                        class="ml-1 bg-red-100 text-red-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Eliminar</span>
                                </button>
                            @endif
                        </td>
                    </tr>

                    <!-- Subcategorías -->
                    @if (!empty($categoria['subcategorias']))
                        <tr id="dropdown-{{ $categoria['id'] }}"
                            class="hidden transition-transform duration-300 transform scale-y-0">
                            <td colspan="4" class="pl-8">
                                <table class="w-full">
                                    @foreach ($categoria['subcategorias'] as $subcategoria)
                                        <tr>
                                            <td class="p-3 border-b border-gray-200">
                                                <button
                                                    onclick="toggleDropdown('dropdown-{{ $categoria['id'] }}-{{ $subcategoria['id'] }}')"
                                                    class="flex items-center w-full font-medium text-left text-blue-500">
                                                    <span>{{ $subcategoria['nombre'] }}</span>
                                                    @if (!empty($subcategoria['sub_sub_categorias']))
                                                        <i id="icon-{{ $categoria['id'] }}-{{ $subcategoria['id'] }}"
                                                            class="ml-2 transition-transform duration-300 fas fa-chevron-down"></i>
                                                    @endif
                                                </button>
                                            </td>
                                            <td class="p-3 border-b border-gray-200">Subcategoría</td>
                                            <td class="p-3 border-b border-gray-200">
                                                {{ $subcategoria['descripcion'] ?? 'Sin descripción' }}</td>
                                            <td class="flex items-center p-3 space-x-2 border-b border-gray-200">
                                                @if (!empty($subcategoria['sub_sub_categorias']))
                                                    <button type="button"
                                                        wire:click='editSubCategoria({{ $subcategoria['id'] }})'
                                                        class="flex items-center text-green-600 hover:text-green-800">
                                                        <i class="fas fa-edit"></i>
                                                        <span
                                                            class="ml-1 bg-green-100 text-green-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Editar</span>
                                                    </button>
                                                @else
                                                    <button type="button"
                                                        wire:click='editSubCategoria({{ $subcategoria['id'] }})'
                                                        class="flex items-center text-green-600 hover:text-green-800">
                                                        <i class="fas fa-edit"></i>
                                                        <span
                                                            class="ml-1 bg-green-100 text-green-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Editar</span>
                                                    </button>
                                                    <button type="button"
                                                        wire:click='eliminarSubCategoria({{ $subcategoria['id'] }})'
                                                        class="flex items-center text-red-600 hover:text-red-800">
                                                        <i class="fas fa-trash-alt"></i>
                                                        <span
                                                            class="ml-1 bg-red-100 text-red-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Eliminar</span>
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>

                                        <!-- Sub-subcategorías -->
                                        @if (!empty($subcategoria['sub_sub_categorias']))
                                            <tr id="dropdown-{{ $categoria['id'] }}-{{ $subcategoria['id'] }}"
                                                class="hidden transition-transform duration-300 transform scale-y-0">
                                                <td colspan="4" class="pl-12">
                                                    <table class="w-full">
                                                        @foreach ($subcategoria['sub_sub_categorias'] as $subsubcategoria)
                                                            <tr>
                                                                <td class="p-3 text-gray-700 border-b border-gray-100">
                                                                    {{ $subsubcategoria['nombre'] }}
                                                                </td>
                                                                <td class="p-3 text-gray-500 border-b border-gray-100">
                                                                    Sub-subcategoría</td>
                                                                <td class="p-3 border-b border-gray-100">
                                                                    {{ $subsubcategoria['descripcion'] ?? 'Sin descripción' }}
                                                                </td>
                                                                <td
                                                                    class="flex items-center p-3 space-x-2 border-b border-gray-100">
                                                                    <button type="button"
                                                                        wire:click='editSubSubCategoria({{ $subsubcategoria['id'] }})'
                                                                        class="flex items-center text-green-600 hover:text-green-800">
                                                                        <i class="fas fa-edit"></i>
                                                                        <span
                                                                            class="ml-1 bg-green-100 text-green-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Editar</span>
                                                                    </button>
                                                                    <button type="button"
                                                                        wire:click='eliminarSubSubCategoria({{ $subsubcategoria['id'] }})'
                                                                        class="flex items-center text-red-600 hover:text-red-800">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                        <span
                                                                            class="ml-1 bg-red-100 text-red-700 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded">Eliminar</span>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </table>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function toggleDropdown(id) {
            const dropdown = document.getElementById(id);
            if (dropdown) {
                dropdown.classList.toggle('hidden');
                dropdown.classList.toggle('scale-y-100');
            }

            const iconId = 'icon-' + id.split('-')[1];
            const subIconId = id.split('-')[2] ? '-' + id.split('-')[2] : '';
            const icon = document.getElementById(iconId + subIconId);
            if (icon) {
                icon.classList.toggle('rotate-180');
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

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
