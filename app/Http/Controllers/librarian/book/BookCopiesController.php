<?php

namespace App\Http\Controllers\librarian\book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookCopies;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BookCopiesController extends Controller
{
    public function index (Request $request, int $book_id) {

        $book = Book::with('category', 'bookAuthor.authors', 'copies')
        ->whereNull('deleted_at')
        ->find($book_id);

        return view('librarian.book_copies.index', compact('book'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();

            $count = BookCopies::where('book_id', $request->add_book_id)->withTrashed()->count();

            $nextNumber = $count + 1;

            $ascensionNumber = 'BK-' . $request->add_book_id . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

            BookCopies::create([
                'book_id' => $request->add_book_id,
                'ascension_number' => $ascensionNumber,
                'barcode' => $request->barcode,
                'status' => 'available',
                'condition' => $request->condition,
                'created_at' => now(),
            ]);
            
            DB::commit();

            $notification = [
                'message' => 'Book Copy added successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.bookCopies.index', $request->add_book_id)
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

            $book = BookCopies::findOrFail($request->edit_book_copy_id);

            $book->update([
                'barcode' => $request->edit_barcode,
                'condition' => $request->edit_condition,
            ]);
            
            DB::commit();

            $notification = [
                'message' => 'Book Copy update successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.bookCopies.index', $book->book_id)
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

    public function delete(int $bookCopyId) {
        DB::beginTransaction();

        try
        {

            $copy = BookCopies::find($bookCopyId);

            if ($copy->status == 'borrowed') {
                return response()->json([
                    'status' => 'error',
                    'text' => "This copy is currently borrowed.",
                ], 200);
            }
            else if ($copy->status == 'reserved') {
                return response()->json([
                    'status' => 'error',
                    'text' => "This copy is currently reserved.",
                ], 200);
            }
            else {
                $copy->delete();
            }
            
            DB::commit();

            return response()->json([
                'status' => 'success',
            ], 200);

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

    public function checkBarcode(Request $request)
    {
        $query = BookCopies::withTrashed()
            ->where('barcode', $request->barcode);

        // Edit mode: ignore the current record
        if ($request->filled('id')) {
            $query->where('id', '!=', $request->id);
        }

        $exists = $query->exists();

        return response()->json(!$exists);
    }
}
