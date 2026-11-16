<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RentalController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('rental.index'));


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {

   
    Route::get('/rental', [RentalController::class, 'index'])->name('rental.index');

    
    Route::middleware('role:admin')->group(function () {
        Route::resource('rental', RentalController::class)->except(['index', 'show']);
    });
});