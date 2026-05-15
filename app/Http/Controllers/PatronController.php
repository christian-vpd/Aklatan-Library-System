<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatronController extends Controller
{
    public function dashboard(Request $request) {
        return view('patron.dashboard');
    }
}
