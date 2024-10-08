<div class="flex justify-center items-center">
    <div class="rounded-md shadow-md w-1/3 flex">
        <figure>
            <img src="{{ 'https://api-happypetshco-com.preview-domain.com/ServidorProductos/' . $datos['imagen'] }}"
                alt="Imagen servicio {{ $datos['nm_producto'] }}" class="w-full" />
        </figure>
        <div class="card-body">
            <h2 class="card-title">{{ $datos['nm_producto'] }}</h2>
            <p>{{ $datos['descripcion'] }}</p>
            <div class="card-actions justify-end">
                <button class="btn btn-secondary">Editar</button>
                <button class="btn btn-primary">eliminar</button>
            </div>
        </div>
    </div>
</div>
