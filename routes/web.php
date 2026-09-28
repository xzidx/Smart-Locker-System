<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\LockerMaintenanceController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\DashboardController;

// Authentication
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Protected pages (user must be logged in)
Route::middleware('auth')->group(function () {
    // Dashboard
   Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

Route::get('/dashboard/staff', [StaffDashboardController::class, 'index'])
    ->name('staff.dashboard');



    // Dashboard (FIXED: now uses the controller so the data is passed to the view)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Locations
    Route::resource('locations', LocationController::class);

    // Reservation (route names: reservation.index, reservation.show, ...)
    Route::resource('reservation', LockerUsageController::class);

    // Lockers
    Route::resource('lockers', LockerController::class);

    // Locker Usage
    Route::resource('locker_usage', LockerUsageController::class);

    // Locker Maintenance
    Route::resource('locker_maintenance', LockerMaintenanceController::class);

    // Settings
    Route::get('/settings', function () {
        return view('settings.index');
    })->name('settings');

    // Reservation Checkout
    Route::get('/reservation_checkout', function () {
        return view('reservation_checkout.index');
    })->name('reservation_checkout');
});

















































































































































    // Location detail pages (moved inside auth group)
    Route::get('/locations/details/{id}', function ($id) {
        return view('locations.details', ['lockerId' => $id]);
    })->name('locations.details');

    Route::get('/locations/locker/{id}', function ($id) {
        return view('locations.locker', ['lockerId' => $id]);
    })->name('locations.locker');
