<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\DashboardController;


Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard');
=======
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\LockerMaintenanceController;

Route::resource('locations', LocationController::class);
Route::resource('lockers', LockerController::class);
Route::resource('locker-usage', LockerUsageController::class);
Route::resource('locker-maintenance', LockerMaintenanceController::class);

Route::get('/', function () {
    return view('dashboard');
});
>>>>>>> main
