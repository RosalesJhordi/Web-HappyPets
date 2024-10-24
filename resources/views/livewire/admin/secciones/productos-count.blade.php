<div wire:poll='totalProd'
    class="flex items-center justify-start w-full h-32 gap-2 px-5 py-5 text-gray-400 bg-white border rounded-sm shadow-md md:w-1/5">
    <span class="flex items-center justify-center text-xl text-blue-600 bg-blue-200 rounded-full w-14 h-14">
        <i class="fa-solid fa-bowl-food"></i>
    </span>
    <span>
        <h1 class="text-3xl font-bold text-gray-900">
            {{ is_array($totalproductos) ? count($totalproductos) : 0 }}
        </h1>
        <h2 class="text-sm font-semibold">Productos Totales</h2>
    </span>
</div>
