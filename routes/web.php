<?php

use App\Http\Controllers\ViewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('Registro',[ViewsController::class,'registro'])->name('Registro');
Route::get('Login',[ViewsController::class,'login'])->name('Logib');
