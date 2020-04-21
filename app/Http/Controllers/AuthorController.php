<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

/**
 * Se tomen decisiones en relación a los Request
 */
class AuthorController extends Controller
{
    /**
     * Retreive all authors
     */
    public function index() {
        return Author::all();
    }

    /**
     * Get one author by id
     */
    public function show($id) {
        $author = Author::find($id);
        return $author;
    }

    /**
     * Update existing author
     */
    public function update(Request $request, $id) {
        $author = Author::find($id);
        $author->update($request->all());
        return $author;
    }

    /**
     * Creates author
     */
    public function store(Request $request) {
        $author = Author::create($request->all());
        return $author->id;
    }

    public function delete($id) {

    }
}
