<?php

namespace App\Http\Controllers\librarian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Announcement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function index (Request $request) {
       
        $announcement = Announcement::with('librarian')
        ->orderBy('created_at', 'desc')
        ->latest()
        ->limit(100)
        ->get();

        return view('librarian.announcement.index', compact('announcement'));
    }

    public function store (Request $request) {
        try {
            DB::beginTransaction();

            Announcement::create([
                'librarian_id' => Auth::user()->librarian->id,
                'title' => $request->title,
                'type' => $request->type,
                'body' => $request->body,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Announcement store successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.announcement.index')
                ->with('notification', $notification);
        }
        catch (\Exception $e)
        {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit (int $announcement_id) {
        $announcement = Announcement::with('librarian')
        ->find($announcement_id);

        return response()->json($announcement);
    }

    public function update (Request $request) {
        try {
            DB::beginTransaction();

            $announcement = Announcement::find($request->edit_announcement_id);

            $announcement->update([
                'title' => $request->edit_title,
                'type' => $request->edit_type,
                'body' => $request->edit_body,
                'is_active' => $request->edit_active,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Announcement update successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.announcement.index')
                ->with('notification', $notification);
        }
        catch (\Exception $e)
        {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete (int $announcement_id) {
        DB::beginTransaction();

        try
        {
            $announcement = Announcement::find($announcement_id);
            $announcement->delete();
            
            DB::commit();

            return response()->json([
                'status' => 'success',
            ], 200);

        }
        catch (\Exception $e)
        {
            DB::rollBack();
            Log::info($e);
            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function filter(Request $request) {
        $query = Announcement::with('librarian');

        if ($request->filled('filter_active')) {
            $query->where('is_active', $request->filter_active);
        };

        if ($request->filled('filter_announcement_type')) {
            $query->where('type', $request->filter_announcement_type);
        };

        $announcement = $query
        ->orderBy('created_at', 'desc')
        ->get();

        return view('librarian.announcement.index', compact('announcement'));
    }
}
