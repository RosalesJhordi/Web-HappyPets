<div>
    @livewire('admin.secciones.reclamos-count')

    <div wire:poll='reclamos' class="flex items-center justify-center w-full py-6 bg-gray-50">
        <div class="flex flex-col-reverse w-full max-w-2xl p-4 bg-white divide-y divide-y-reverse rounded-lg shadow-lg">
            @foreach ($reclamos as $index => $reclamo)
                <div class="w-full px-6 py-4 mb-6 transition-transform transform bg-gray-100 rounded-lg hover:scale-105 hover:shadow-xl">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-semibold text-gray-800">{{ $reclamo['nombres'] }}</span>
                            <span class="text-xs text-gray-500">Hace {{ \Carbon\Carbon::parse($reclamo['created_at'])->diffForHumans() }}</span>
                        </div>
                    </div>

                    <p class="mb-4 text-base text-gray-800">
                        Reclamo:
                        <br>
                        <span class="block px-4 py-3 mt-2 text-sm font-medium leading-relaxed text-gray-900 break-words border border-gray-300 rounded-lg shadow-sm bg-gray-50">
                            {{ $reclamo['reclamo'] }}
                        </span>
                    </p>


                    <div class="flex items-center space-x-3">
                        <span class="px-3 py-1 text-xs font-medium text-red-800 bg-red-100 rounded-full">Urgente</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
