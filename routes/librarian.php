<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\librarian\PatronTypesController;
use App\Http\Controllers\librarian\AuthorController;
use App\Http\Controllers\librarian\PatronController;
use App\Http\Controllers\librarian\AnnouncementController;
use App\Http\Controllers\librarian\AccountSettingController;
use App\Http\Controllers\librarian\book\CategoriesController;
use App\Http\Controllers\librarian\book\ManageBooksController;

Route::prefix('librarian/account_settings')->middleware(['auth', 'role:librarian'])->controller(AccountSettingController::class)->group(function() {
    Route::get('index', [AccountSettingController::class, 'index'])->name('librarian.account_settings.index');
    Route::post('update', [AccountSettingController::class, 'update'])->name('librarian.account_settings.update');
    Route::post('changePassword', [AccountSettingController::class, 'changePassword'])->name('librarian.account_settings.changePassword');
});

Route::prefix('/librarian')->middleware(['auth', 'role:librarian'])->controller(LibrarianController::class)->group(function() {
    Route::get('dashboard', [LibrarianController::class, 'dashboard'])->name('librarian.dashboard');
});

Route::prefix('/categories')->middleware(['auth', 'role:librarian'])->controller(CategoriesController::class)->group(function() {
    Route::get('index', [CategoriesController::class, 'index'])->name('librarian.category.index');
    Route::post('store', [CategoriesController::class, 'store'])->name('librarian.category.store');
    Route::post('update', [CategoriesController::class, 'update'])->name('librarian.category.update');
    Route::delete('delete/{category_id}', [CategoriesController::class, 'delete'])->name('librarian.category.delete');
});

Route::prefix('/manage-books')->middleware(['auth', 'role:librarian'])->controller(ManageBooksController::class)->group(function() {
    
});

Route::prefix('librarian/author')->middleware(['auth', 'role:librarian'])->controller(AuthorController::class)->group(function() {
    Route::get('index', [AuthorController::class, 'index'])->name('librarian.author.index');
    Route::post('store', [AuthorController::class, 'store'])->name('librarian.author.store');
    Route::post('update', [AuthorController::class, 'update'])->name('librarian.author.update');
    Route::delete('delete/{author_id}', [AuthorController::class, 'delete'])->name('librarian.author.delete');
});

Route::prefix('librarian/patrons')->middleware(['auth', 'role:librarian'])->controller(PatronController::class)->group(function() {
    Route::get('index', [PatronController::class, 'index'])->name('librarian.patron.index');
    Route::post('checkEmail', [PatronController::class, 'checkEmail'])->name('librarian.patron.checkEmail');
    Route::post('store', [PatronController::class, 'store'])->name('librarian.patron.store');
    Route::get('edit/{user_id}', [PatronController::class, 'edit'])->name('librarian.patron.edit');
    Route::post('update', [PatronController::class, 'update'])->name('librarian.patron.update');
    Route::delete('delete/{user_id}', [PatronController::class, 'delete'])->name('librarian.patron.delete');
    Route::get('filter', [PatronController::class, 'filter'])->name('librarian.patron.filter');
});

Route::prefix('librarian/patron_types')->middleware(['auth', 'role:librarian'])->controller(PatronTypesController::class)->group(function () {
    Route::get('index', [PatronTypesController::class, 'index'])->name('librarian.patronTypes.index');
    Route::post('store', [PatronTypesController::class, 'store'])->name('librarian.patronType.store');
    Route::post('update', [PatronTypesController::class, 'update'])->name('librarian.patronType.update');
    Route::delete('delete/{patron_type_id}', [PatronTypesController::class, 'delete'])->name('librarian.patronType.delete');
});

Route::prefix('librarian/announcement')->middleware(['auth', 'role:librarian'])->controller(AnnouncementController::class)->group(function () {
    Route::get('index', [AnnouncementController::class, 'index'])->name('librarian.announcement.index');
    Route::post('store', [AnnouncementController::class, 'store'])->name('librarian.announcement.store');
    Route::get('edit/{announcement_id}', [AnnouncementController::class, 'edit'])->name('librarian.announcement.edit');
    Route::post('update', [AnnouncementController::class, 'update'])->name('librarian.announcement.update');
    Route::delete('delete/{announcement_id}', [AnnouncementController::class, 'delete'])->name('librarian.announcement.delete');
    Route::get('filter', [AnnouncementController::class, 'filter'])->name('librarian.announcement.filter');
});