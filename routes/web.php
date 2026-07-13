<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'redirectIfAuthenticated']);
Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');