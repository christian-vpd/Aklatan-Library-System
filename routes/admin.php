<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\LibrarianController;
use App\Http\Controllers\admin\LibraryHoursController;
use App\Http\Controllers\admin\PoliciesController;

Route::prefix('/admin')->middleware(['auth', 'role:superadmin'])->controller(AdminController::class)->group(function() {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::prefix('/admin')->middleware(['auth', 'role:superadmin'])->controller(LibrarianController::class)->group(function() {
    Route::get('/manage_librarians', [LibrarianController::class, 'index'])->name('admin.manage_librarians.index');
    Route::post('manage_librarians/store', [LibrarianController::class, 'store'])->name('admin.manage_librarians.store');
    Route::post('manage_librarians/checkEmail', [LibrarianController::class, 'checkEmail'])->name('admin.manage_librarians.checkEmail');
    Route::get('manage_librarians/edit/{user_id}', [LibrarianController::class, 'edit'])->name('admin.manage_librarians.edit');
    Route::post('manage_librarians/update', [LibrarianController::class, 'update'])->name('admin.manage_librarians.update');
    Route::get('manage_librarians/toggle/{user_id}', [LibrarianController::class, 'toggle'])->name('admin.manage_librarians.toggle');
    Route::get('manage_librarians/inactive', [LibrarianController::class, 'getInactive'])->name('admin.manage_librarians.inactive');
    Route::delete('manage_librarians/delete/{user_id}', [LibrarianController::class, 'delete'])->name('admin.manage_librarians.delete');
});

Route::prefix('/admin/library_hours')->middleware(['auth', 'role:superadmin'])->controller(LibraryHoursController::class)->group(function () {
    Route::get('index', [LibraryHoursController::class, 'index'])->name('admin.library_hours.index');
    Route::post('update', [LibraryHoursController::class, 'update'])->name('admin.library_hours.update');
});

Route::prefix('/admin/policies')->middleware(['auth', 'role:superadmin'])->controller(PoliciesController::class)->group(function () {
    Route::get('index', [PoliciesController::class, 'index'])->name('admin.policies.index');
    Route::get('category/{category_id}', [PoliciesController::class, 'category'])->name('admin.policies.category');
    // Category
    Route::post('category/store', [PoliciesController::class, 'categoryStore'])->name('admin.policies.category.store');
    Route::post('category/update', [PoliciesController::class, 'categoryUpdate'])->name('admin.policies.category.update');
    Route::delete('category/delete/{category_id}', [PoliciesController::class, 'categoryDelete'])->name('admin.policies.category.delete');
    // Policy
    Route::post('store', [PoliciesController::class, 'store'])->name('admin.policies.store');
    Route::post('update', [PoliciesController::class, 'update'])->name('admin.policies.update');
    Route::delete('delete/{policy_id}', [PoliciesController::class, 'delete'])->name('admin.policies.delete');
});