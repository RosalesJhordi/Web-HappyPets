<div wire:poll='totalMascotas'
    class="w-1/5 h-32 bg-white border rounded-sm shadow-md text-gray-400 px-5 py-5 flex justify-start items-center gap-2">
    <span class="rounded-full text-purple-600 bg-purple-200 w-14 h-14 flex justify-center items-center text-xl">
        <i class="fa-solid fa-paw"></i>
    </span>
    <span>
        <h1 class="text-3xl text-gray-900 font-bold">
            {{ count($totalMascotas) }}
        </h1>
        <h2 class="text-sm font-semibold">Mascotas Totales</h2>
    </span>
</div>
