<?php

use App\Http\Controllers\ViewsController;
use App\Http\Middleware\CheckPermissions;
use App\Livewire\Admin\Usuarios\Empleados;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('/');

Route::get('NoAutorizado', function(){
    return view('noAutorizado');
})->name('NoAutorizado');

Route::get('Registro',[ViewsController::class,'registro'])->name('Registro');
Route::get('Login',[ViewsController::class,'login'])->name('Login');

Route::middleware([CheckPermissions::class. ':Administrador'])->group(function () {
    Route::get('Admin', [ViewsController::class, 'admin'])->name('Admin');
});

Route::get('/Productos',function(){
    return view('Productos');
})->name('Productos');


Route::get('Servicios',function(){
    return view('Servicios');
})->name('Servicios');

Route::get('ShowCarrito',function(){
    return view('Carrito');
})->name('ShowCarrito');

Route::get('Perfil',function(){
    return view('Perfil');
})->name('Perfil');
