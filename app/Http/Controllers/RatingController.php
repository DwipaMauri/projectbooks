<?php

namespace App\Http\Controllers;

use App\Models\author;
use App\Models\book;
use App\Models\rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = author::orderBy('name', 'asc')->get();
        $books = book::with('author')->paginate(50);
        return view('ratings.create', compact('authors', 'books'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'rating' => 'required|integer|between:1,10',
        ]);

        // Create new rating
        rating::create([
            'book_id' => $request->book_id,
            'rating' => $request->rating,
        ]);

        // Redirect to the list of books
        return redirect()->route('books.index')->with('success', 'Rating submitted successfully');
    }

    public function getbooks($author_id)
    {
        $books = book::where('author_id', $author_id)->get();
        return response()->json($books);
    }
}
