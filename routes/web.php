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
    Route::get('admin/inicio', [ViewsController::class, 'admin'])->name('Admin');
    Route::get('admin/producto', [ViewsController::class, 'productos'])->name('Admin.Productos');
    Route::get('admin/servicios', [ViewsController::class, 'servicios'])->name('Admin.Servicios');
    Route::get('admin/citas/hoy', [ViewsController::class, 'citasHoy'])->name('Admin.Citas.Hoy');
    Route::get('admin/citas/semana', [ViewsController::class, 'citasSemana'])->name('Admin.Citas.Semana');
    Route::get('admin/citas/mes', [ViewsController::class, 'citasMes'])->name('Admin.Citas.Mes');
    Route::get('admin/mascotas', [ViewsController::class, 'mascotas'])->name('Admin.Mascotas');
    Route::get('admin/usuarios/clientes', [ViewsController::class, 'clientes'])->name('Admin.Clientes');
    Route::get('admin/usuarios/empleados', [ViewsController::class, 'empleados'])->name('Admin.Empleados');
    Route::get('admin/categorias',[ViewsController::class, 'categorias'])->name('Admin.Categorias');
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
