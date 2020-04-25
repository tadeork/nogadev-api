<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public function show($id) {
        return Book::find($id);
    }

    /**
     * Display all books
     */
    public function index() {
        $mediterreanFruits = array('manzana', 'naranja', 'uva');
        $tropicalFruits = array('ananá', 'mango');

        $fruitSalad = $this->mix($mediterreanFruits, $tropicalFruits);
        $fruitSaladWithoutMango = $this->removeFruit($fruitSalad, 'mango');

        $this->serveTrait($fruitSaladWithoutMango);
    }

    protected function mix($mainElements, $companionElement) {
        foreach ($companionElement as $companion) {
            array_push($mainElements, $companion);
        }
        
        return $mainElements;
    }

    protected function serveTrait($mealTrait) {
        foreach ($mealTrait as $key => $trait) {
            print_r('key: ' . $key . ' => ' . 'value: ' . $trait. '</br>' );
        }
    }

    protected function removeFruit($fruitSalad, $notDesiredFruit) {
        foreach ($fruitSalad as $fruit) {
            if ($notDesiredFruit == $fruit) {
                array_pop($fruit);
            }
        }

        return $fruitSalad;
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
