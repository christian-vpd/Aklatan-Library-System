<?php

namespace App\Http\Controllers\librarian\book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Book;
use App\Models\BookAuthor;
use App\Models\BookCopies;
use App\Models\Author;
use App\Models\Categories;

class ManageBooksController extends Controller
{
    public function index(Request $request) {

        $category = Categories::all();

        $authors = Author::all();

        $books = Book::with('category', 'bookAuthor.authors')
        ->whereNull('deleted_at')
        ->latest()
        ->limit(50)
        ->get();

        return view('librarian.manage_books.index', compact('books', 'category', 'authors'));
    }

    public function store(Request $request) {
        try {
            DB::beginTransaction();

            $book = Book::create([
                'title' => $request->title,
                'isbn' => $request->isbn,
                'description' => $request->description,
                'publisher' => $request->publisher,
                'publication_year' => $request->year_published,
                'category_id' => $request->category,
                'created_by' => Auth::user()->id,
                'created_at' => now(),
            ]);

            if (is_array($request->authors)) {
                foreach ($request->authors as $authorId) {
                    BookAuthor::create([
                        'book_id'   => $book->id,
                        'author_id' => $authorId,
                    ]);
                }
            }
            
            DB::commit();

            $notification = [
                'message' => 'Book added successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.manageBooks.index')
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

    public function edit(Request $request, int $book_id) {
        $book = Book::with('bookAuthor')
        ->find($book_id);

        return response()->json($book);
    }

    public function update(Request $request) {
        try {
            DB::beginTransaction();

            $book = Book::findOrFail($request->edit_book_id);

            $book->update([
                'title' => $request->edit_title,
                'isbn' => $request->edit_isbn,
                'description' => $request->edit_description,
                'publisher' => $request->edit_publisher,
                'publication_year' => $request->edit_year_published,
                'category_id' => $request->edit_category,
            ]);

            $bookAuthor = BookAuthor::where('book_id', $request->edit_book_id)->delete();

            if (is_array($request->edit_authors)) {
                foreach ($request->edit_authors as $authorId) {
                    BookAuthor::create([
                        'book_id'   => $book->id,
                        'author_id' => $authorId,
                    ]);
                }
            }
            
            DB::commit();

            $notification = [
                'message' => 'Book update successfully.',
                'alert_type' => 'success',
                'title' => 'Success',
            ];

            return redirect()
                ->route('librarian.manageBooks.index')
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

    public function delete(int $bookId) {
        DB::beginTransaction();

        try
        {

            $book = Book::find($bookId);
            $count = BookCopies::where('book_id', $bookId)->count();

            if ($count > 0) {
                return response()->json([
                    'status' => 'error',
                    'text' => "There are still copies on this book.",
                ], 200);
            }
            else {
                $bookAuthor = BookAuthor::where('book_id', $bookId)->delete();
                $book->delete();
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

    public function filter(Request $request) {

        $category = Categories::all();

        $authors = Author::all();

        $keyword = $request->input('filter_keyword');

        $books = Book::with('category', 'bookAuthor.authors')
        ->whereNull('deleted_at')
        ->when($keyword, function ($query, $keyword) {
            return $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                ->orWhere('description', 'like', "%{$keyword}%");
            });
        })
        ->limit(50)
        ->get();

        return view('librarian.manage_books.index', compact('books', 'category', 'authors'));
    }
}
