<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CharityRequestController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CharityController;
use App\Http\Controllers\UserNotifController;
use App\Http\Controllers\DonatorController;
use App\Models\Donator;

Route::resource('charity', CharityController::class)->only('index');
Route::post('/charity/update', [CharityController::class, 'update'])->name('charity.update-status');


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('auth/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('social.redirect')
    ->where('provider', 'google|facebook');
Route::get('/forceLogout', function (Request $request) {
    Auth::logout();
    return redirect('/');
});
Route::get('auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->name('social.callback')
    ->where('provider', 'google|facebook');


Route::get('/', function () {
    return view('pages.userPage');
});



Route::middleware(['auth', 'role:user'])->group(function () {
    // Profile Controller Sections
    Route::put('/update-profile', [ProfileController::class, 'updateInfo'])->name('update-profile');
    Route::put('/reset-password', [ProfileController::class, 'resetPassword'])->name('reset-password');
    Route::post('/verify-gcash', [ProfileController::class, 'verifyGcash'])->name('verify-gcash');
    Route::post('/verify-images', [ProfileController::class, 'verifyImages'])->name('verify-images');
    Route::get('/profile', [ProfileController::class, 'showProfile'])->name('profile');

    // Charity Request Controller Sections
    Route::resource('charity-requests', CharityRequestController::class)->only('show', 'store');
    Route::post('/cancel-charity/{charityRequestID}', [CharityRequestController::class, 'cancelCharityRequest'])->name('user-cancel-charity');

    // User Notifications Controller Sections
    Route::resource('user-notifications', UserNotifController::class)->only('show');
    Route::post('/mark-as-read/{notificationID}', [UserNotifController::class, 'markAsRead'])->name('user-notifications.mark-as-read');

    // User Charity Sections
    Route::resource('charity', CharityController::class)->only('show');

    // Donation Sections
    Route::resource('donate', DonatorController::class)->only('store');
   
});


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('pages.adminPage');
    });
    // Route::resource('admin', AdminController::class);
    Route::softDeletableResources([
        '/admin/users' => UserController::class,
    ]);
    Route::delete('/admin/users/forceDelete/{userID}', [UserController::class, 'forceDelete'])->name('admin.users.forceDelete');
    Route::put('/admin/users/restore/{userID}', [UserController::class, 'restore'])->name('admin.users.restore');
    // Charity Request Controller Sections
    Route::resource('charity-requests', CharityRequestController::class)->only('index');
    Route::get('charity-requests/show', [CharityRequestController::class, 'show'])->name('charity-requests.show');
    Route::post('/reject-charity-request/{charityRequestID}', [CharityRequestController::class, 'rejectCharityRequest'])->name('charity-requests.reject');
    Route::post('/approve-charity-request/{charityRequestID}', [CharityRequestController::class, 'approveCharityRequest'])->name('charity-requests.approve');

    //ProperNaming Po
    Route::resource('/admin/charity-requests', CharityRequestController::class)->only('index', 'update');
    Route::get('/admin/charity-requests/show', [CharityRequestController::class, 'show'])->name('charity-requests.show');
    Route::post('/admin/reject-charity-request/{charityRequestID}', [CharityRequestController::class, 'rejectCharityRequest'])->name('charity-requests.reject');
});
    // User Charity Sections
    Route::post('/cancel-charity-list/{charityID}', [CharityController::class, 'cancelCharity'])->name('charity.cancel');
// });

