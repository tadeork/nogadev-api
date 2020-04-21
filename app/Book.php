<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // protected $table = 'books';
    protected $fillable = ['title', 'description', 'yearOfPublication', 'editorial', 'author_id'];

    function author() {
        return $this->belongsTo('App\Author');
    }
}
