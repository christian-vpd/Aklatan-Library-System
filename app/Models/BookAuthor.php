<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{

    protected $guarded = [];

    public function books() {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function authors() {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
}
