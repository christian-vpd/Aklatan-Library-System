<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatronController;

Route::prefix('/patron')->middleware(['auth', 'role:patron'])->controller(PatronController::class)->group(function() {
    Route::get('dashboard', [PatronController::class, 'dashboard'])->name('patron.dashboard');
});