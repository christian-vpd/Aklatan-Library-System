<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use App\Models\LibraryHours;
use App\Models\PolicyCategories;

class AdminController extends Controller
{
    public function dashboard(Request $request) {

        $totalBook = Book::where('deleted_at', null)->count();

        $activeLibrarians = User::where('deleted_at', null)
        ->where('role', 'librarian')
        ->where('status', 'active')
        ->count();

        $activePatrons = User::where('deleted_at', null)
        ->where('role', 'patron')
        ->where('status', 'active')
        ->count();

        $borrowed = Borrow::where('deleted_at', null)
        ->where('status', 'borrowed')
        ->count();

        $libraryHours = LibraryHours::all();

        $policies = PolicyCategories::all();

        return view('admin.dashboard', compact('totalBook', 'activeLibrarians', 'activePatrons', 'borrowed', 'libraryHours', 'policies'));
    }
}
