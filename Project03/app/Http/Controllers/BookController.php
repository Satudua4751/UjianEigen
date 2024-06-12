<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @OA\Info(title="Book API", version="1.0")
 */
class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/book",
     *     summary="Get list of books",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Book")
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $book = Book::all();
        return view('book.index', compact('book'));
    }

    /**
     * @OA\Post(
     *     path="/api/book",
     *     summary="Create a new book",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Book created"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function create(Request $request)
    {
        $book = $request->input('codeb');
        return view('book.create', compact('book'));
    }

    /**
     * @OA\Get(
     *     path="/api/book/{codeb}",
     *     summary="Get a book by ID",
     *     @OA\Parameter(
     *         name="codeb",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     )
     * )
     */
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

    /**
     * @OA\Get(
     *     path="/api/book/{codeb}",
     *     summary="Get a book by codeb",
     *     @OA\Parameter(
     *         name="codeb",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     )
     * )
     */
    public function show($codeb)
    {
        $book = Book::findOrFail($codeb);
        return view('book.show', compact('book'));
    }

    /**
     * @OA\Put(
     *     path="/api/book/{codeb}",
     *     summary="Update a book by ID",
     *     @OA\Parameter(
     *         name="codeb",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book updated"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/book/{codeb}",
     *     summary="Delete a book by ID",
     *     @OA\Parameter(
     *         name="codeb",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Book not found"
     *     )
     * )
     */
    public function destroy($codeb)
    {
        $book = Book::findOrFail($codeb);
        $book->delete();

        return redirect()->route('book.index')->with('success', 'Deleted successfully.');
    }
}

/**
 * @OA\Schema(
 *     schema="Book",
 *     type="object",
 *     title="Book",
 *     required={"codeb", "title", "author", "stock"},
 *     @OA\Property(property="codeb", type="string"),
 *     @OA\Property(property="title", type="string"),
 *     @OA\Property(property="author", type="string"),
 *     @OA\Property(property="stock", type="integer"),
 *     @OA\Property(property="created_at", type="string", format="date-time", readOnly=true),
 *     @OA\Property(property="updated_at", type="string", format="date-time", readOnly=true)
 * )
 */
