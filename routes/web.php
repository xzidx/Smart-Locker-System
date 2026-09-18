<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
return view('Reservation.index');
    return view('dashboard');
});

Route::get('/reservations/active', function () {
    return view('Active_Locker.index');
});