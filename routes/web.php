<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\LockerMaintenanceController;

Route::resource('locations', LocationController::class);
Route::resource('lockers', LockerController::class);
Route::resource('locker-usage', LockerUsageController::class);
Route::resource('locker-maintenance', LockerMaintenanceController::class);



// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');


// Locations
Route::resource('locations', LocationController::class);


// Reservation
Route::resource('reservation', LockerUsageController::class);


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

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/', function () {
    return view('auth.login');
})->name('login');

Route::post('/register', function () {
    return 'Registration submitted!';
})->name('register.store');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');




Route::get('/reservation_checkout', function () {
    return view('reservation_checkout.index');
});