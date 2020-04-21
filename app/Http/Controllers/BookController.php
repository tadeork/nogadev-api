<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public function show($id) {
        return Book::find($id);
    }

    public function index() {
        return Book::all();
    }

    /**
     * Update existing author
     */
    public function update(Request $request, $id) {
        $author = Book::find($id);
        $author->update($request->all());
        return $author;
    }

    /**
     * Creates author
     */
    public function store(Request $request) {
        $author = Book::create($request->all());
        return $author->id;
    }

    public function delete($id) {
        if (Book::find($id)) {
            $book = Book::find($id);
            $book->delete();

            return response()->json(["message" => "Book deleted"], 202);
        }

        return response()->json(["message" => "Book not found"], 404);
    }
}
