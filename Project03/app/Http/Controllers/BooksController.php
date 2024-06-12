<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $request->validate([
            'codeb' => 'required|string|max:10',
            'title' => 'required|string|max:100',
            'author' => 'required|string|max:100',
            'stock' => 'required|integer'
        ]);

        $book = Book::create($request->only(['codeb', 'title', 'author', 'stock']));
        return response()->json($book, 201);
    }

    public function show($codeb)
    {
        $book = Book::findOrFail($codeb);
        return response()->json($book);
    }

    public function update(Request $request, $codeb)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'author' => 'required|string|max:100',
            'stock' => 'required|integer'
        ]);

        $book = Book::findOrFail($codeb);
        $book->update($request->only(['title', 'author', 'stock']));
        return response()->json($book);
    }

    public function destroy($codeb)
    {
        $book = Book::findOrFail($codeb);
        $book->delete();
        return response()->json(null, 200);
    }
}
