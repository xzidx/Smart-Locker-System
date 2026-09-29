<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\LockerController;
use App\Http\Controllers\LockerUsageController;
use App\Http\Controllers\LockerMaintenanceController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationCheckoutController;

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

Route::middleware('auth')->group(function () {


    // Dashboardstaff

Route::get('/dashboard/staff', [StaffDashboardController::class, 'index'])
    ->name('staff.dashboard');

    // Dashboard (FIXED: now uses the controller so the data is passed to the view)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Locations
    Route::resource('locations', LocationController::class);

    // Reservation (route names: reservation.index, reservation.show, ...)
    Route::resource('reservation', ReservationController::class);

    // Lockers
    Route::resource('lockers', LockerController::class);

    // Locker Usage
    Route::resource('locker_usage', LockerUsageController::class);

    // Locker Maintenance
    Route::resource('locker_maintenance', LockerMaintenanceController::class);

    Route::get('/settings', [ProfileController::class, 'index'])
    ->name('settings');

Route::get('/settings/profile/edit', [ProfileController::class, 'edit'])
    ->name('settings.profile.edit');

Route::put('/settings/profile', [ProfileController::class, 'update'])
    ->name('settings.profile.update');

   // Reservation Checkout
    Route::get(
        '/reservation_checkout/{lockerId}',
        [ReservationController::class, 'checkout']
    )->name('reservation.checkout');
});
















































// Reservation
Route::resource('reservation', ReservationController::class);

































































































