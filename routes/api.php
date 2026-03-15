<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\BookingApiController;
use App\Http\Controllers\Api\HouseApiController;
use App\Http\Controllers\Api\PaymentApiController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [AuthApiController::class, 'login']);

Route::middleware('api.token')->group(function () {
    Route::get('/houses', [HouseApiController::class, 'index']);
    Route::get('/houses/{house}', [HouseApiController::class, 'show']);

    Route::get('/bookings', [BookingApiController::class, 'index']);
    Route::post('/bookings', [BookingApiController::class, 'store']);

    Route::post('/payments', [PaymentApiController::class, 'store']);
});
