<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\ServiceOrderItemController;
use App\Http\Controllers\PaymentController;

Route::get('/', fn () => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.attempt');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::resource('customers', CustomerController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('parts', PartController::class);
    Route::resource('service-orders', ServiceOrderController::class);
    Route::resource('service-order-items', ServiceOrderItemController::class);
    Route::resource('payments', PaymentController::class);

    Route::middleware('role:admin,owner')->group(function () {
        Route::resource('users', UserController::class);
    });
});
