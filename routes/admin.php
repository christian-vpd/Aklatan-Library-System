<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\LibrarianController;

Route::prefix('/admin')->middleware(['auth', 'role:superadmin'])->controller(AdminController::class)->group(function() {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::prefix('/admin')->middleware(['auth', 'role:superadmin'])->controller(LibrarianController::class)->group(function() {
    Route::get('/manage_librarians', [LibrarianController::class, 'index'])->name('admin.manage_librarians.index');
    Route::post('manage_librarians/store', [LibrarianController::class, 'store'])->name('admin.manage_librarians.store');
    Route::post('manage_librarians/checkEmail', [LibrarianController::class, 'checkEmail'])->name('admin.manage_librarians.checkEmail');
    Route::get('manage_librarians/edit/{user_id}', [LibrarianController::class, 'edit'])->name('admin.manage_librarians.edit');
    Route::post('manage_librarians/update', [LibrarianController::class, 'update'])->name('admin.manage_librarians.update');
});