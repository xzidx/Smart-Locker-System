<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\LockerMaintenanceController;
use App\Http\Controllers\ReservationController;

Route::resource('locations', LocationController::class);
Route::resource('lockers', LockerController::class);
Route::resource('locker_usage', LockerUsageController::class);
Route::resource('locker_maintenance', LockerMaintenanceController::class);
Route::resource('reservation', ReservationController::class);


// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');


// Locations
Route::resource('locations', LocationController::class);


// Reservation
Route::resource('reservation', ReservationController::class);


// Lockers
Route::resource('lockers', LockerController::class);


// Locker Usage / Reservation
Route::resource('locker_usage', LockerUsageController::class);


// Locker Maintenance
Route::resource('locker_maintenance', LockerMaintenanceController::class);


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
