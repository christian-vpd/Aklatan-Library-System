<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatronController;
use App\Http\Controllers\patron\AccountSettingController;

Route::prefix('/patron')->middleware(['auth', 'role:patron'])->controller(PatronController::class)->group(function() {
    Route::get('dashboard', [PatronController::class, 'dashboard'])->name('patron.dashboard');
});

Route::prefix('patron/account_settings')->middleware(['auth', 'role:patron'])->controller(AccountSettingController::class)->group(function() {
    Route::get('index', [AccountSettingController::class, 'index'])->name('patron.account_settings.index');
    Route::post('update', [AccountSettingController::class, 'update'])->name('patron.account_settings.update');
    Route::post('changePassword', [AccountSettingController::class, 'changePassword'])->name('patron.account_settings.changePassword');
    Route::post('checkEmail', [AccountSettingController::class, 'checkEmail'])->name('patron.account_settings.checkEmail');
});