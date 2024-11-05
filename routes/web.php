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
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Route for login (show form)
Route::get('/login', function () {
    return view('auth.login'); // Make sure you have a view for login
})->name('login');

// Route to handle login form submission
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route to handle logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
