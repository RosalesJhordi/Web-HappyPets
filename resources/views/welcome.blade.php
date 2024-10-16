@extends('Layout.App')

@section('titulo')
    Inicio
@endsection

@section('contenido')
    @livewire('admin.secciones.slide')
    <div class="w-full">

        @livewire('productos.todos')
        @livewire('productos.descuentos')
        @livewire('citas.views')
        <div class="visme_d" style="height: 50vh;" data-title="Contact Form" data-url="8r6nwpjm-contact-form"
            data-domain="forms" data-full-page="false" data-min-height="1000px" data-form-id="40366"></div>
        <script src="https://static-bundles.visme.co/forms/vismeforms-embed.js"></script>

    </div>
@endsection
