<div class="w-full">
    <div class="grid w-full grid-cols-2 gap-2 py-5 md:gap-5 md:flex md:flex-wrap md:grid-cols-4">
        @if (Session::get('authToken'))
            @livewire('admin.secciones.usuarios-count')
            @livewire('admin.secciones.ganancias')
            @livewire('admin.secciones.productos-count')
            @livewire('admin.secciones.mascotas-count')
            @livewire('admin.secciones.servicios-count')
            @livewire('admin.secciones.categorias-count')
        @endif

    </div>
    <h1 class="text-xl font-semibold text-gray-400">Graficos</h1>
    <div class="grid flex-wrap w-full grid-cols-1 gap-5 py-5 md:grid-cols-2">
        @livewire('admin.graficos.grafico1')
        @livewire('admin.graficos.grafico2')
        @livewire('admin.graficos.grafico3')
        @livewire('admin.graficos.grafico4')
    </div>
    <div class="grid items-center justify-center w-full gap-5 md:flex">
        <div class="tableii">
            <div class="w-full h-full overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="py-2 text-center text-gray-600">
                    <h1 class="text-lg font-semibold">Tabla Usuarios</h1>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nombres</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Apellidos</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Teléfono</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Fecha Creación</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($datosClientes as $clientes)
                            <tr>
                                <th class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</th>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $clientes['nombres'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $clientes['apellidos'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $clientes['telefono'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($clientes['created_at'])->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tableii2">
            <div class="w-full h-full overflow-x-auto bg-white border border-gray-200 rounded-lg shadow-sm">
                <div class="py-2 text-center text-gray-600">
                    <h1 class="text-lg font-semibold">Tabla Empleados</h1>
                </div>
                <table class="min-w-full divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Nombres</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">DNI</th>
                            <th class="px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">Permisos</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($datosEmpleados as $empleado)
                            <tr>
                                <th class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</th>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $empleado['nombres'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $empleado['dni'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <ul class="flex flex-wrap gap-2">
                                        @foreach ($empleado['permisos'] as $permiso)
                                            <li class="px-2 py-1 text-xs font-medium text-white bg-blue-500 rounded-full">{{ $permiso }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
