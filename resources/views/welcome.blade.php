@extends('Layout.App')

@section('titulo')
    Inicio
@endsection

@section('contenido')
    @livewire('admin.secciones.slide')
    <div class="w-full">

        @livewire('productos.todos')
        @livewire('servicios.todas')
        @livewire('veterinarios.inicio')

        <div class="visme_d" data-title="Contact Form" data-url="8r6nwpjm-contact-form" data-domain="forms"
            data-full-page="false" data-min-height="500px" data-form-id="40366"></div>
        <script src="https://static-bundles.visme.co/forms/vismeforms-embed.js"></script>

        <script src="https://www.onirix.com/webar/ox-devicemotion.min.js"></script>
        <div class="flex items-center justify-center w-full h-screen">
            <iframe id="visor" style="max-width:100vw;width:800px;height:100%; display:block;border:none;"
            src="https://player.onirix.com/exp/LRmkE5?&background=alpha&preview=true&hide_controls=true&ar_button=false"
            allow="web-share;camera;gyroscope;accelerometer;magnetometer;autoplay;fullscreen;xr-spatial-tracking;geolocation;"></iframe>
        </div>
    </div>
@endsection
