<div wire:poll='totalMascotas'
    class="flex items-center justify-start w-full h-32 gap-2 px-5 py-5 text-gray-400 bg-white border rounded-sm shadow-md  md:w-1/5">
    <span class="flex items-center justify-center text-xl text-purple-600 bg-purple-200 rounded-full w-14 h-14">
        <i class="fa-solid fa-paw"></i>
    </span>
    <span>
        <h1 class="text-3xl font-bold text-gray-900">
            {{ count($totalMascotas) }}
        </h1>
        <h2 class="text-sm font-semibold">Mascotas Totales</h2>
    </span>
</div>
