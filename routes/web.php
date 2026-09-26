<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\LockerMaintenanceController;
use App\Http\Controllers\ReservationController;


// =====================================================
// Dashboard
// =====================================================

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


// =====================================================
// Locations / Find Locker
// =====================================================

// Find Locker page
Route::get('/locations', [LocationController::class, 'findLocker'])
    ->name('locations.index');

// Location Detail page
Route::get('/locations/{location}', [LocationController::class, 'show'])
    ->name('locations.show');


// =====================================================
// Lockers
// =====================================================

Route::resource('lockers', LockerController::class);


// =====================================================
// Locker Usage
// =====================================================

Route::resource('locker-usage', LockerUsageController::class);


// =====================================================
// Locker Maintenance
// =====================================================

Route::resource('locker-maintenance', LockerMaintenanceController::class);


// =====================================================
// Reservations
// =====================================================

Route::get('/reservations', [ReservationController::class, 'index'])
    ->name('reservations.index');


// =====================================================
// Settings
// =====================================================

Route::get('/settings', function () {
    return view('settings.index');
})->name('settings');


// =====================================================
// Login
// =====================================================

Route::get('/login', function () {
    return view('auth.login');
})->name('login');


// =====================================================
// Register
// =====================================================

Route::get('/register', function () {
    return view('auth.register');
})->name('register');