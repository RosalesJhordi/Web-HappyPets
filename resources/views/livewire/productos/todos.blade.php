<div class="flex flex-col py-2">

    <div class="w-full flex justify-center items-center">
        <div wire:loading.remove class="w-full grid grid-cols-5 sm:grid-cols-2 md:grid-cols-2  lg:grid-cols-3 xl:grid-cols-4  py-5 gap-6 flex-wrap">
            @if (!empty($datos))
                @foreach ($datos as $dato)
                    <div class="card card-compact rounded-md border bg-base-100 w-full shadow-xl">
                        <figure>
                            <img src="{{ 'https://api-happypetshco-com.preview-domain.com/ServidorProductos/' . $dato['imagen'] }}"
                                alt="Imagen servicio {{ $dato['nm_producto'] }}" class="w-full object-cover h-72" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">{{ $dato['nm_producto'] }}</h2>
                            <p>{{ $dato['descripcion'] }}</p>
                            <p>{{ $dato['categoria'] }}</p>
                            <div class="card-actions justify-end">
                                {{-- @livewire('modal.reservar-cita',['id_servicio' => $dato['id']]) --}}
                                <a href="{{ route('ShowServicio',$dato['id']) }}" class="btn btn-primary">
                                    Añadir a carrito
                                    <i class="fa-solid fa-cart-shopping"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="w-full h-96 flex flex-col justify-center items-center py-10">
                    <div class="avatar">
                        <div class="mask mask-squircle w-64">
                            <img src="{{ asset('img/oops.jpg') }}" alt="oops img">
                        </div>
                    </div>
                    <p class="text-3xl text-gray-400">No se encontraron servicios en esta categoria</p>
                </div>
            @endif
        </div>
        <div wire:loading class="w-full h-screen">
            <div class="flex w-full flex-col gap-4 px-40 py-5">
                <div class="loading loading-spinner loading-lg text-2xl text-gray-400 text-center">Cargando...</div>
                <div class="skeleton h-60 w-full"></div>
                <div class=" h-72 w-full flex justify-between gap-2">
                    <div class="skeleton h-72 w-1/2"></div>
                    <div class="skeleton h-72 w-1/2"></div>
                </div>
            </div>
        </div>
    </div>
</div>
