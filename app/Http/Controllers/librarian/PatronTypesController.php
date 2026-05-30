<?php

namespace App\Http\Controllers\librarian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\PatronType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PatronTypesController extends Controller
{
    public function index(Request $request) {

        $patronTypes = PatronType::with('addedBy')->get();

        return view('librarian.patron_types.index', compact('patronTypes'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            
            PatronType::create([
                'name' => $request->name,
                'description' => $request->description,
                'added_by' => Auth::user()->id,
                'max_books' => $request->maxBooks,
                'borrow_days' => $request->borrowDays,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Patron Type added successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.patronTypes.index')
                ->with('notification', $notification);
        }
        catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request) {
        try {
            DB::beginTransaction();

            $update = PatronType::find($request->patron_type_id);
            
            $update->update([
                'name' => $request->edit_name,
                'description' => $request->edit_description,
                'max_books' => $request->edit_maxBooks,
                'borrow_days' => $request->edit_borrowDays,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Patron Type updated successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.patronTypes.index')
                ->with('notification', $notification);
        }
        catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function delete(int $patron_type_id) {
        try {
            DB::beginTransaction();

            $delete = PatronType::with('patrons')->find($patron_type_id);

            $count = $delete->patrons->count();

            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'text' => "There are still patrons on this type.",
                ], 200);
            }

            DB::commit();

            $delete->delete();

            return response()->json([
                'status' => 'success',
            ], 200);
        }
        catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Internal Server Error.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
