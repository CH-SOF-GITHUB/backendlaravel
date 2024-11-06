<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route for registration (show form)
Route::get('/register', function () {
    return view('auth.register'); // Make sure you have a view for registration
})->name('register');

// Route to handle registration form submission
//Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Route for login (show form)
Route::get('/login', function () {
    return view('auth.login'); // Make sure you have a view for login
})->name('login');

// Route for dashboard (show form)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth:sanctum');

// Route for reset password (show form)
Route::get('/reset', function(){
    return view('auth.reset'); // Make sure you have a view for password reset
})->name('password.request');
