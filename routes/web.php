<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\LockerMaintenanceController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ProfileController;

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


 // =====================================================
    // Profile
    // ===================================================== 
Route::resource('locker-maintenance', LockerMaintenanceController::class);

Route::middleware(['auth'])->group(function () {
   

    Route::get('/settings/profile', [ProfileController::class, 'edit'])
        ->name('setting.profile');

    Route::put('/settings/profile', [ProfileController::class, 'update'])
        ->name('setting.profile.update');
});































































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