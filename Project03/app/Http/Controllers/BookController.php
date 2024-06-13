<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    public function index(Request $request)
    {
        $book = Book::all();
        return view('book.index', compact('book'));
    }

    public function create(Request $request)
    {
        $book = $request->input('codeb');
        return view('book.create', compact('book'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codeb' => 'required|string|max:10',
            'title' => 'required|string|max:100',
            'author' => 'required|string|max:100',
            'stock' => 'required|integer'
        ]);

        DB::transaction(function () use ($request) {
            $book = Book::create($request->only(['codeb', 'title', 'author', 'stock']));
            $book->save();
        });

        return redirect()->route('book.index')->with('success', 'Book has been added');
    }

    public function show($codeb)
    {
        $book = Book::findOrFail($codeb);
        return view('book.show', compact('book'));
    }

    public function edit($codeb)
    {
        $book = Book::findOrFail($codeb);
        return view('book.edit', compact('book'));
    }

    public function update(Request $request, $codeb)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'author' => 'required|string|max:100',
            'stock' => 'required|integer'
        ]);

        try {
            DB::transaction(function () use ($request, $codeb) {
                $book = Book::findOrFail($codeb);
                $book->update($request->only(['title', 'author', 'stock']));
                $book->save();
            });

            return redirect()->route('book.index')->with('success', 'Book has been updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update Book: ' . $e->getMessage());
        }
    }

    public function destroy($codeb)
    {
        $book = Book::findOrFail($codeb);
        $book->delete();

        return redirect()->route('book.index')->with('success', 'Deleted successfully.');
    }
}
