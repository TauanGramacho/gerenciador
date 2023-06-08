<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/', HomeController::class)->name('home');
Route::post('inicial', [UsuarioController::class, 'login'])->name('usuarios.login');
Route::get('/cadastro', function () {
    return view('cadastro');
})->name('cadastro');
Route::get('/inicial', function () {
    return view('inicial');
})->name('inicial');
Route::get('/logout', [UsuarioController::class, 'destroy'])->name('logout');


