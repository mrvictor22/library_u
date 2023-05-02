<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookLoan;
class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return $books;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $book = new Book;
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->isbn = $request->input('isbn');
        $book->publisher = $request->input('publisher');
        $book->edition = $request->input('edition');
        $book->quantity = $request->input('quantity');
        $book->save();

        return response()->json([
            'message' => 'Book created successfully',
            'book' => $book
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show($query)
    {
        $book = Book::where('title', 'like', '%'.$query.'%')
            ->orWhere('author', 'like', '%'.$query.'%')
            ->orWhere('isbn', 'like', '%'.$query.'%')
            ->first();
        if ($book) {
            return response()->json($book);
        } else {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book, $id)
    {
        $book = Book::findorFail($id);
        if ($book) {
            $book->title = $request->input('title');
            $book->author = $request->input('author');
            $book->isbn = $request->input('isbn');
            $book->publisher = $request->input('publisher');
            $book->edition = $request->input('edition');
            $book->quantity = $request->input('quantity');
            $book->save();
            return response()->json(['message' => 'Book updated successfully', 'book' => $book], 200);
        } else {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, $id)
    {
        $book = Book::destroy($id);
        if ($book) {
            return response()->json(['message' => 'Book deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Book not found'], 404);
        }
    }

    public function lendBook(Request $request)
    {
        $bookId = $request->input('book_id');
        $studentId = $request->input('student_id');

        $book = Book::find($bookId);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        if ($book->quantity <= 0) {
            return response()->json(['message' => 'No copies available'], 400);
        }

        $loan = new BookLoan;
        $loan->book_id = $bookId;
        $loan->student_id = $studentId;
        $loan->due_date = Carbon::now();
        $loan->returned_date = Carbon::now()->addDays(14);
        $loan->save();

        $book->quantity--;
        $book->save();

        return response()->json([
            'message' => 'Book lent successfully',
            'book_loan' => $loan
        ], 200);
    }
}
