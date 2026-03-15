<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\EstateController;
use App\Http\Controllers\HouseBookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:ADMINISTRATOR')->group(function () {
        // User management routes
        Route::resource('users', UserController::class);
    });

    Route::middleware('role:ADMINISTRATOR,LANDLORD,TENANT')->group(function () {
        // House browsing routes
        Route::resource('houses', HouseController::class)->only(['index', 'show']);
    });

    Route::middleware('role:ADMINISTRATOR,LANDLORD')->group(function () {
        // House and estate management routes
        Route::resource('houses', HouseController::class)->except(['index', 'show']);
        Route::resource('estates', EstateController::class);
    });

    // Booking management routes
    Route::resource('bookings', HouseBookingController::class)
        ->middleware('role:ADMINISTRATOR,LANDLORD,TENANT');
});

require __DIR__.'/auth.php';
