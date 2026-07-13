<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'redirectIfAuthenticated']);
Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::get('register', [RegisterController::class, 'register'])->name('register')->middleware('guest');

Route::middleware('auth')->group(function () {

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});
