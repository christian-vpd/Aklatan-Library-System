<?php

namespace App\Http\Controllers\librarian\book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function index(Request $request) {

        $categories = Categories::all();

        return view('librarian.categories.index', compact('categories'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();
            
            Categories::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Category added successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.category.index')
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

            $update = Categories::find($request->edit_category_id);
            
            $update->update([
                'name' => $request->edit_name,
                'description' => $request->edit_description,
            ]);

            DB::commit();

            $notification = [
                'message' => 'Category updated successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.category.index')
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

    public function delete(int $category_id) {
        try {
            DB::beginTransaction();

            $delete = Categories::with('book')->find($category_id);

            $count = $delete->book->count();

            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'text' => "There are still books on this category.",
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
