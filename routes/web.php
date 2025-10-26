<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/', function () {
    return view('pages.userPage');
});

Route::middleware(['auth'])->group(function () {
    Route::put('/update-profile', [ProfileController::class, 'updateInfo'])->name('update-profile');
    Route::put('/reset-password', [ProfileController::class, 'resetPassword'])->name('reset-password');
    Route::post('/verify-gcash', [ProfileController::class, 'verifyGcash'])->name('verify-gcash');
    Route::post('/verify-images', [ProfileController::class, 'verifyImages'])->name('verify-images');
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('pages.adminPage');
    });
});