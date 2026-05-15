<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibrarianController extends Controller
{
    public function dashboard(Request $request) {
        return view('librarian.dashboard');
    }
}
