<div>
    @foreach ($datos as $dato)
        <div class="border shadow-md">
            <h1>{{ $dato['cantidad'] }}</h1>
            <p>{{ $dato['color'] }}</p>
            <p>{{ $dato['importe'] }}</p>
            <p>{{ $dato['pagado'] ?? "False" }}</p>
            <p>{{ $dato['tipo_pago'] }}</p>
            <p>{{ $dato['producto']['nm_producto'] }}</p>
            <img class="w-20 h-20" src="{{ 'https://api-happypetshco-com.preview-domain.com/ServidorProductos/' . $dato['producto']['imagen'] }}" alt="">
        </div>
    @endforeach

    importe total: {{$importeTotal}}
</div>
