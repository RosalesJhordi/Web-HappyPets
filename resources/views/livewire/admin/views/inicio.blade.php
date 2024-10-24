<div class="w-full" >
    <div class="grid w-full grid-cols-2 gap-2 py-5 md:gap-5 md:flex md:grid-cols-4">

        @livewire('admin.secciones.usuarios-count')
        @livewire('admin.secciones.ganancias')
        @livewire('admin.secciones.productos-count')
        @livewire('admin.secciones.mascotas-count')
        @livewire('admin.secciones.servicios-count')

    </div>
    <h1 class="text-xl font-semibold text-gray-400">Graficos</h1>
    <div class="grid flex-wrap w-full grid-cols-1 gap-5 py-5 md:flex">
        @livewire('admin.graficos.grafico1')
        @livewire('admin.graficos.grafico2')
        @livewire('admin.graficos.grafico3')
        @livewire('admin.graficos.grafico4')
        <div class="grid items-center justify-center w-full grid-cols-1 gap-5 md:flex ">
            <div class="tableii">
                <div class="w-full h-full overflow-x-auto bg-white border">
                    <table class="table">
                        <h1 class="py-2 text-center text-gray-400">Tabla Usuarios</h1>
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox" />
                                    </label>
                                </th>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Favorite Color</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox" />
                                    </label>
                                </th>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="w-12 h-12 mask mask-squircle">
                                                <img src="https://img.daisyui.com/images/profile/demo/2@94.webp"
                                                    alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">Hart Hagerty</div>
                                            <div class="text-sm opacity-50">United States</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    Zemlak, Daniel and Leannon
                                    <br />
                                    <span class="badge badge-ghost badge-sm">Desktop Support Technician</span>
                                </td>
                                <td>Purple</td>
                                <th>
                                    <button class="btn btn-ghost btn-xs">details</button>
                                </th>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox" />
                                    </label>
                                </th>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="w-12 h-12 mask mask-squircle">
                                                <img src="https://img.daisyui.com/images/profile/demo/3@94.webp"
                                                    alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">Brice Swyre</div>
                                            <div class="text-sm opacity-50">China</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    Carroll Group
                                    <br />
                                    <span class="badge badge-ghost badge-sm">Tax Accountant</span>
                                </td>
                                <td>Red</td>
                                <th>
                                    <button class="btn btn-ghost btn-xs">details</button>
                                </th>
                            </tr>
                            <!-- row 3 -->
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox" />
                                    </label>
                                </th>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="w-12 h-12 mask mask-squircle">
                                                <img src="https://img.daisyui.com/images/profile/demo/4@94.webp"
                                                    alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">Marjy Ferencz</div>
                                            <div class="text-sm opacity-50">Russia</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    Rowe-Schoen
                                    <br />
                                    <span class="badge badge-ghost badge-sm">Office Assistant I</span>
                                </td>
                                <td>Crimson</td>
                                <th>
                                    <button class="btn btn-ghost btn-xs">details</button>
                                </th>
                            </tr>
                            <!-- row 4 -->
                            <tr>
                                <th>
                                    <label>
                                        <input type="checkbox" class="checkbox" />
                                    </label>
                                </th>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="w-12 h-12 mask mask-squircle">
                                                <img src="https://img.daisyui.com/images/profile/demo/5@94.webp"
                                                    alt="Avatar Tailwind CSS Component" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">Yancy Tear</div>
                                            <div class="text-sm opacity-50">Brazil</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    Wyman-Ledner
                                    <br />
                                    <span class="badge badge-ghost badge-sm">Community Outreach
                                        Specialist</span>
                                </td>
                                <td>Indigo</td>
                                <th>
                                    <button class="btn btn-ghost btn-xs">details</button>
                                </th>
                            </tr>
                        </tbody>
                        <!-- foot -->
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Favorite Color</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="tableii2">
                <div class="w-full h-full overflow-x-auto bg-white border">
                    <table class="table table-zebra ">
                        <!-- head -->
                        <h1 class="py-2 text-center text-gray-400">Tabla Empleados</h1>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Job</th>
                                <th>Favorite Color</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr>
                                <th>1</th>
                                <td>Cy Ganderton</td>
                                <td>Quality Control Specialist</td>
                                <td>Blue</td>
                            </tr>
                            <!-- row 2 -->
                            <tr>
                                <th>2</th>
                                <td>Hart Hagerty</td>
                                <td>Desktop Support Technician</td>
                                <td>Purple</td>
                            </tr>
                            <!-- row 3 -->
                            <tr>
                                <th>3</th>
                                <td>Brice Swyre</td>
                                <td>Tax Accountant</td>
                                <td>Red</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

