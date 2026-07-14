<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Pocket\PocketController;
use App\Http\Controllers\Transaction\TopUpBankController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'redirectIfAuthenticated']);
Route::get('login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::get('register', [RegisterController::class, 'register'])->name('register')->middleware('guest');


Route::middleware('auth')->group(function () {

    Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('pocket', [PocketController::class, 'index'])->name('pocket.index');
    Route::get('pocket/create', [PocketController::class, 'create'])->name('pocket-create');

    Route::get('top-up/list-bank', [TopUpBankController::class, 'listBank'])
        ->name('list-bank');
 
    Route::get('top-up/status/{vaNumber}', [TopUpBankController::class, 'checkTopupPayment'])
        ->name('status');
});
