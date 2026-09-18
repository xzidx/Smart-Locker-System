<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('user-dashboard');
});


Route::get('/user-dashboard', [DashboardController::class, 'index'])
    ->name('user.dashboard');