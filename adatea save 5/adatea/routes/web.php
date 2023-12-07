<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\OrderController;




Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::resource('product', ProductController::class);
Route::resource('appointment', AppointmentController::class);
Route::resource('order', OrderController::class);
Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::get('/dashboard', [AppointmentController::class, 'dashboard'])->name('dashboard');
Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])
    ->name('appointments.show');
