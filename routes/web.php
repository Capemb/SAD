<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthSpa\LoginController;
use App\Http\Controllers\Api\AuthSpa\RegisterController;
use App\Http\Controllers\Api\AuthSpa\LogoutController;



Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth')->group(function () {
    Route::post('/login', LoginController::class);
    Route::post('/register', RegisterController::class);
    Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');
});





