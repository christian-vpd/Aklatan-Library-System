<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LibraryHours;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LibraryHoursController extends Controller
{
    public function index(Request $request) {

        $days = LibraryHours::all();

        return view('admin.library_hours.index', compact('days'));
    }
    
    public function update(Request $request) {
        DB::beginTransaction();

        try
        {

            $hour = LibraryHours::find($request->hourId);
            
            $close = $request->close;

            if ($close == 'on') {
                $hour->open_time = null;
                $hour->close_time = null;
                $hour->is_closed = 1;
            }
            else {
                $hour->open_time = $request->opening_hours;
                $hour->close_time = $request->closing_hours;
                $hour->is_closed = 0;
            };

            $hour->save();
        
            DB::commit();

            $notification = [
                'message' => 'Library Hours update successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('admin.library_hours.index')
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
}
