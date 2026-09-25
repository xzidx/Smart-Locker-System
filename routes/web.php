<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\LockerMaintenanceController;
use App\Http\Controllers\ReservationController;


// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


// Locations
Route::resource('locations', LocationController::class);


// Lockers
Route::resource('lockers', LockerController::class);


// Locker Usage
Route::resource('locker-usage', LockerUsageController::class);


// Locker Maintenance
Route::resource('locker-maintenance', LockerMaintenanceController::class);


// Reservations
Route::get('/reservations', [ReservationController::class, 'index'])
    ->name('reservations.index');


// Settings
Route::get('/settings', function () {
    return view('settings.index');
})->name('settings');


// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');


// Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');