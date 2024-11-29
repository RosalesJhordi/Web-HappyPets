<?php

use App\Http\Controllers\ViewsController;
use App\Http\Middleware\CheckPermissions;
use App\Livewire\Admin\Usuarios\Empleados;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Response;
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
    Route::get('admin/citas', [ViewsController::class, 'citasHoy'])->name('Admin.Citas.Hoy');
    Route::get('admin/mascotas', [ViewsController::class, 'mascotas'])->name('Admin.Mascotas');
    Route::get('admin/usuarios/clientes', [ViewsController::class, 'clientes'])->name('Admin.Clientes');
    Route::get('admin/usuarios/empleados', [ViewsController::class, 'empleados'])->name('Admin.Empleados');
    Route::get('admin/categorias',[ViewsController::class, 'categorias'])->name('Admin.Categorias');
    Route::get('admin/libroreclamos', [ViewsController::class, 'libro'])->name('Admin.Libro');
    Route::get('admin/ventas',[ViewsController::class, 'ventas'])->name('Admin.Ventas');
    Route::get('admin/pedidos',[ViewsController::class, 'pedidos'])->name('Admin.Pedidos');
});
Route::middleware([CheckPermissions::class. ':Almacenero'])->group(function () {
    Route::get('admin/producto', [ViewsController::class, 'productos'])->name('Admin.Productos');
    Route::get('admin/categorias',[ViewsController::class, 'categorias'])->name('Admin.Categorias');
});
Route::middleware([CheckPermissions::class. ':Veterinario'])->group(function () {
    Route::get('admin/citas', [ViewsController::class, 'citasHoy'])->name('Admin.Citas.Hoy');
    Route::get('admin/mascotas', [ViewsController::class, 'mascotas'])->name('Admin.Mascotas');
    Route::get('admin/servicios', [ViewsController::class, 'servicios'])->name('Admin.Servicios');
});
Route::middleware([CheckPermissions::class. ':Cajero/Vendedor'])->group(function () {
    Route::get('admin/ventas',[ViewsController::class, 'ventas'])->name('Admin.Ventas');
    Route::get('admin/pedidos',[ViewsController::class, 'pedidos'])->name('Admin.Pedidos');
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


Route::get('SobreNosotros',function(){
    return view('SobreNosotros');
})->name('SobreNosotros');
Route::get('/download-apk', function () {
    $filePath = public_path('apk/happypets.apk');
    $fileName = 'happypets.apk';

    if (file_exists($filePath)) {
        return Response::download($filePath, $fileName);
    }

    abort(404, 'El archivo no fue encontrado.');
})->name('download.apk');
