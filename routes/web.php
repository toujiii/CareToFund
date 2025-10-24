<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.userPage');
});

Route::get('/admin', function () {
    return view('pages.adminPage');
});