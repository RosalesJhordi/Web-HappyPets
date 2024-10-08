<div class="w-full">
    <div class="w-full py-5 flex gap-5">
        <div
            class="w-1/5 h-32 bg-white border rounded-sm shadow-md text-gray-400 px-5 py-5 flex justify-start items-center gap-2">
            <span
                class="rounded-full text-blue-600 bg-blue-200 w-14 h-14 flex justify-center items-center text-xl">
                <i class="fa-solid fa-users"></i>
            </span>
            <span>
                <h1 class="text-3xl text-gray-900 font-bold">{{count($totaluser)}}</h1>
                <h2 class="text-sm font-semibold">Usuarios Totales</h2>
            </span>
        </div>

        <div
            class="w-1/5 h-32 bg-white border rounded-sm shadow-md text-gray-400 px-5 py-5 flex justify-start items-center gap-2">
            <span
                class="rounded-full text-blue-600 bg-blue-200 w-14 h-14 flex justify-center items-center text-xl">
                <i class="fa-solid fa-sack-dollar"></i>
            </span>
            <span>
                <h1 class="text-3xl text-gray-900 font-bold">$456.000</h1>
                <h2 class="text-sm font-semibold">Ganacias totales</h2>
            </span>
        </div>

        <div
            class="w-1/5 h-32 bg-white border rounded-sm shadow-md text-gray-400 px-5 py-5 flex justify-start items-center gap-2">
            <span
                class="rounded-full text-blue-600 bg-blue-200 w-14 h-14 flex justify-center items-center text-xl">
                <i class="fa-solid fa-cart-shopping"></i>
            </span>
            <span>
                <h1 class="text-3xl text-gray-900 font-bold">{{ count($totalproductos) }}</h1>
                <h2 class="text-sm font-semibold">Productos Totales</h2>
            </span>
        </div>

        {{-- <div
            class="w-1/5 h-32 bg-white border rounded-sm shadow-md text-gray-400 px-5 py-5 flex justify-start items-center gap-2">
            <span
                class="rounded-full text-blue-600 bg-blue-200 w-14 h-14 flex justify-center items-center text-xl">
                <i class="fa-solid fa-syringe"></i>
            </span>
            <span>
                <h1 class="text-3xl text-gray-900 font-bold">{{ count($totalservicios) }}</h1>
                <h2 class="text-sm font-semibold">Servicios Totales</h2>
            </span>
        </div> --}}

    </div>
    <h1 class="text-gray-400 font-semibold text-xl">Graficos</h1>
    <div class="flex w-full flex-wrap gap-5 py-5">
        @livewire('admin.graficos.grafico1')
        @livewire('admin.graficos.grafico2')
        @livewire('admin.graficos.grafico3')
        {{-- <div id="chart2" class="bg-white h-1/2" style="width: 100%;"></div>
        <div id="chart3" class="bg-white h-1/2" style="width: 100%;"></div> --}}
        @livewire('admin.graficos.grafico4')
        {{-- <div id="chart4" class="bg-white h-full" style="width: 100%;"></div> --}}
        <div class="w-full flex justify-center items-center gap-5">
            <div class="" style="width: 79%; height: 500px;">
                <div class="overflow-x-auto border bg-white w-full h-full">
                    <table class="table">
                        <h1 class="text-center text-gray-400 py-2">Tabla Usuarios</h1>
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
                                            <div class="mask mask-squircle h-12 w-12">
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
                                            <div class="mask mask-squircle h-12 w-12">
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
                                            <div class="mask mask-squircle h-12 w-12">
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
                                            <div class="mask mask-squircle h-12 w-12">
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
            <div class="" style="width: 29%;height: 500px;">
                <div class="overflow-x-auto border bg-white w-full h-full">
                    <table class="table table-zebra ">
                        <!-- head -->
                        <h1 class="text-center text-gray-400 py-2">Tabla Empleados</h1>
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
