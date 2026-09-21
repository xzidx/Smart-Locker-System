<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('auth.login.index');
})->name('login');

Route::get('/register', function () {
    return view('auth.login.register');
})->name('register');

Route::post('/register', function () {
    // Registration logic will go here
    return 'Registration submitted!';
})->name('register.store');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');