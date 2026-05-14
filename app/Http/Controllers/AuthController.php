<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookCopies;
use App\Models\Patron;
use App\Models\Categories;
use App\Models\LibraryHours;
use App\Models\Announcement;

class AuthController extends Controller
{
    public function index(Request $request) {
        $totalBooks = Book::where('deleted_at', null)->count();
        $categories = Categories::count();
        $borrowed = BookCopies::where('status', 'borrowed')->count();
        $activePatrons = Patron::where('deleted_at', null)->count();

        $libraryHours = LibraryHours::all();
        $announcements = Announcement::where('is_active', 1)
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

        return view("index", compact('totalBooks', 'categories', 'borrowed', 'activePatrons', 'libraryHours', 'announcements'));
    }

    public function login(Request $request) {
        return view("auth.login");
    }
}
