<div class="flex items-center justify-center gap-3">
    <h1 class="">Hola : <span class="font-bold text-sm">{{$nombres}}</span></h1>
    <button  wire:click="deletetoken" class="text-2xl hover:text-gray-400 px-2 tooltip tooltip-bottom" data-tip="Cerrar sesion">
        <i class="fa-solid fa-right-from-bracket"></i>
    </button>
    @if ($permisos == "Administrador")
        <a href="{{ route('Admin') }}">
            <div class="fixed bg-orange-600 p-5 rounded-md text-white bottom-2 z-50 right-2">
                <span>
                    <i class="fa-solid fa-chart-simple"></i>
                </span>
                Administrar
            </div>
        </a>
    @else
    @endif
</div>
