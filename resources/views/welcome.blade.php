@extends('Layout.App')

@section('titulo')
    Inicio
@endsection

@section('contenido')
    @livewire('admin.secciones.slide')
    <div class="w-full px-40 sm:px-5 md:px-14 lg:px-24 xl:px-36 py-5">
        <h1 class="text-gray-400 text-2xl font-semibold ">Productos nuevos</h1>
        @livewire('productos.todos')
    </div>
@endsection
