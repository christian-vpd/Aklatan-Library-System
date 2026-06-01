<?php

namespace App\Http\Controllers\librarian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function index(Request $request) {

        $author = Author::get();

        return view('librarian.author.index', compact('author'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            
            Author::create([
                'name' => $request->name,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Author added successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.author.index')
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

            $update = Author::find($request->edit_author_id);
            
            $update->update([
                'name' => $request->edit_name,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Author update successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.author.index')
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

    public function delete(int $author_id) {
        try {
            DB::beginTransaction();

            $delete = Author::find($author_id);
            $delete->delete();

            DB::commit();

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
