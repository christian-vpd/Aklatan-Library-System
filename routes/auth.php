<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('/')->controller(AuthController::class)->group(function () {
    Route::get('/', [AuthController::class,'index'])->name('index');
    Route::get('/login', [AuthController::class,'login'])->name('login');
    Route::post('/login/account', [AuthController::class, 'loginSubmit'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
