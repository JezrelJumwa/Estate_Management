<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\EstateController;
use App\Http\Controllers\HouseBookingController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MaintenanceRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TenantPortalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

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

    Route::middleware('role:TENANT')->group(function () {
        Route::get('/tenant-portal', [TenantPortalController::class, 'index'])->name('tenant.portal');
    });

    Route::middleware('role:ADMINISTRATOR,LANDLORD,TENANT')->group(function () {
        Route::get('/payments', [PaymentController::class, 'index'])->name('payments.index');
        Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
        Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');

        Route::get('/maintenance-requests', [MaintenanceRequestController::class, 'index'])->name('maintenance-requests.index');
        Route::get('/maintenance-requests/create', [MaintenanceRequestController::class, 'create'])->name('maintenance-requests.create');
        Route::post('/maintenance-requests', [MaintenanceRequestController::class, 'store'])->name('maintenance-requests.store');
        Route::patch('/maintenance-requests/{maintenanceRequest}', [MaintenanceRequestController::class, 'update'])->name('maintenance-requests.update');

        Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
        Route::get('/documents/create', [DocumentController::class, 'create'])->name('documents.create');
        Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
        Route::get('/documents/{document}/download', [DocumentController::class, 'download'])->name('documents.download');
    });

    Route::middleware('role:ADMINISTRATOR,LANDLORD')->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/payments.csv', [ReportController::class, 'paymentsCsv'])->name('reports.payments.csv');
    });
});

require __DIR__.'/auth.php';
