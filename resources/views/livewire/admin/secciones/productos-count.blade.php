<div wire:poll='totalProd'
    class="w-1/5 h-32 bg-white border rounded-sm shadow-md text-gray-400 px-5 py-5 flex justify-start items-center gap-2">
    <span class="rounded-full text-blue-600 bg-blue-200 w-14 h-14 flex justify-center items-center text-xl">
        <i class="fa-solid fa-bowl-food"></i>
    </span>
    <span>
        <h1 class="text-3xl text-gray-900 font-bold">
            {{ is_array($totalproductos) ? count($totalproductos) : 0 }}
        </h1>
        <h2 class="text-sm font-semibold">Productos Totales</h2>
    </span>
</div>
