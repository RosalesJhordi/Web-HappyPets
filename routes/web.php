<?php

use App\Http\Controllers\ViewsController;
use App\Http\Middleware\CheckPermissions;
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

Route::get('ShowServicio={id}',[ViewsController::class,'show'])->name('ShowServicio');
Route::get('ShowCarrito',function(){
    return view('Carrito');
})->name('ShowCarrito');
