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

Route::get('/', function () {
return view('Reservation.index');
    return view('dashboard');
});

Route::get('/reservations/active', function () {
    return view('Active_Locker.index');
});