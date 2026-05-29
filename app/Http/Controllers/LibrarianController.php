<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Borrow;
use App\Models\Reservation;
use App\Models\Fine;
use App\Models\LibraryHours;

class LibrarianController extends Controller
{
    public function dashboard(Request $request) {

        // Counts
        $borrow = Borrow::where('status', 'borrowed')
        ->where('deleted_at', null)
        ->count();

        $overdue = Borrow::where('status', 'overdue')
        ->where('deleted_at', null)
        ->count();

        $reservation = Reservation::where('status', 'pending')
        ->where('deleted_at', null)
        ->count();

        $fine = Fine::where('status', 'unpaid')
        ->where('deleted_at', null)
        ->sum('amount');

        $libraryHours = LibraryHours::all();

        $recentFines = Fine::with('patron')
        ->where('status', 'unpaid')
        ->orderBy('created_at', 'desc')
        ->limit(7)
        ->get();

        return view('librarian.dashboard', compact('borrow', 'overdue', 'reservation', 'fine', 'libraryHours', 'recentFines'));
    }
}
