<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::prefix('/')->controller(AuthController::class)->group(function () {
    Route::get('/', [AuthController::class,'index'])->name('index');
});
