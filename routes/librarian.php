<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\librarian\PatronTypesController;
use App\Http\Controllers\librarian\AuthorController;

Route::prefix('/librarian')->middleware(['auth', 'role:librarian'])->controller(LibrarianController::class)->group(function() {
    Route::get('dashboard', [LibrarianController::class, 'dashboard'])->name('librarian.dashboard');
});

Route::prefix('librarian/author')->middleware(['auth', 'role:librarian'])->controller(AuthorController::class)->group(function() {
    Route::get('index', [AuthorController::class, 'index'])->name('librarian.author.index');
    Route::post('store', [AuthorController::class, 'store'])->name('librarian.author.store');
    Route::post('update', [AuthorController::class, 'update'])->name('librarian.author.update');
    Route::delete('delete/{author_id}', [AuthorController::class, 'delete'])->name('librarian.author.delete');
});

Route::prefix('librarian/patron_types')->middleware(['auth', 'role:librarian'])->controller(PatronTypesController::class)->group(function () {
    Route::get('index', [PatronTypesController::class, 'index'])->name('librarian.patronTypes.index');
    Route::post('store', [PatronTypesController::class, 'store'])->name('librarian.patronType.store');
    Route::post('update', [PatronTypesController::class, 'update'])->name('librarian.patronType.update');
    Route::delete('delete/{patron_type_id}', [PatronTypesController::class, 'delete'])->name('librarian.patronType.delete');
});