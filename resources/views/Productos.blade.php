@extends('Layout.App')

@section('titulo')
    Productos
@endsection

@section('contenido')
    @livewireStyles
    <div class="flex items-center justify-center w-full">
        @livewire('filtro.producto')
    </div>
    @livewireScripts
@endsection
