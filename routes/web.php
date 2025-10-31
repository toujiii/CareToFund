<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CharityRequestController;
use App\Http\Controllers\Auth\SocialAuthController;

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('social.redirect')
    ->where('provider', 'google|facebook');

Route::get('auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('social.callback')
    ->where('provider', 'google|facebook');

Route::get('/', function () {
    return view('pages.userPage');
});

Route::middleware(['auth'])->group(function () {
    // Profile Controller Sections
    Route::put('/update-profile', [ProfileController::class, 'updateInfo'])->name('update-profile');
    Route::put('/reset-password', [ProfileController::class, 'resetPassword'])->name('reset-password');
    Route::post('/verify-gcash', [ProfileController::class, 'verifyGcash'])->name('verify-gcash');
    Route::post('/verify-images', [ProfileController::class, 'verifyImages'])->name('verify-images');
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');

    // Charity Request Controller Sections
    Route::resource('charity-requests', CharityRequestController::class)->only('show', 'store');
    Route::post('/cancel-charity/{charityRequestID}', [CharityRequestController::class, 'cancelCharityRequest'])->name('user-cancel-charity');
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('pages.adminPage');
    });

    // Charity Request Controller Sections
    Route::resource('charity-requests', CharityRequestController::class)->only('index', 'update');
    Route::get('charity-requests/show', [CharityRequestController::class, 'show'])->name('charity-requests.show');
    Route::post('/reject-charity-request/{charityRequestID}', [CharityRequestController::class, 'rejectCharityRequest'])->name('charity-requests.reject');
});