<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibrarianController;

Route::prefix('/librarian')->middleware(['auth', 'role:librarian'])->controller(LibrarianController::class)->group(function() {
    Route::get('dashboard', [LibrarianController::class, 'dashboard'])->name('librarian.dashboard');
});