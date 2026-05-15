<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookCopies;
use App\Models\Patron;
use App\Models\Categories;
use App\Models\LibraryHours;
use App\Models\Announcement;
use Illuminate\Support\Facades\Auth;

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

    public function loginSubmit(Request $request)
    {
        
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->status !== 'active') {
                Auth::logout();
                return back()->withErrors([
                    'username' => 'Account is not active.',
                ]);
            }

            if ($user->role === 'superadmin') {
                return redirect('/admin/dashboard');
            }

            if ($user->role === 'librarian') {
                return redirect('/librarian/dashboard');
            }

            return redirect('/patron/dashboard');
        }

        return back()->withErrors([
            'username' => 'Invalid username or password',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
