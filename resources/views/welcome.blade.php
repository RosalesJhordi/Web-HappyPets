@extends('Layout.App')

@section('titulo')
    Inicio
@endsection

@section('contenido')
    @livewire('admin.secciones.slide')
    <div class="flex flex-col items-center justify-center w-full">

        @livewire('productos.todos')
        @livewire('servicios.todas')
        @livewire('veterinarios.inicio')

        <div class="visme_d" data-title="Contact Form" data-url="8r6nwpjm-contact-form" data-domain="forms"
            data-full-page="false" data-min-height="500px" data-form-id="40366"></div>
        <script src="https://static-bundles.visme.co/forms/vismeforms-embed.js"></script>

        <h1 class="text-gray-400 md:text-2xl text-semibold">Ubicanos</h1>
        <div id="map" class="w-full h-[60vh] lg:w-1/2 mt-4 rounded-lg shadow-lg z-0"></div>
        <div class="flex items-center justify-center w-full p-2 bg-gray-100 lg:w-1/2">
            <a href="https://player.onirix.com/projects/c71ba637fa3649a1b17dad4676b9f5b9/webar?token=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOjQ3MjU4LCJwcm9qZWN0SWQiOjk2MjUxLCJyb2xlIjozLCJpYXQiOjE3MzMzNTIxOTV9.1hg-PnTQfTjl8PTQHJZkZhGZ_j-2tR0W_Mr-ogKC5oA&launchpad=true" class="w-1/2 btn-primary btn">Experimentar con AR</a>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const map = L.map('map').setView([-9.9325957, -76.2419714], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                const marker = L.marker([-9.932547071381533, -76.24191614890651]).addTo(map);
                marker.bindPopup("<b>HappyPets</b><br>Jr. Aguilar 649 Huánuco").openPopup();
            });
        </script>
    </div>
@endsection
