<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookAuthor extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function books() {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    public function authors() {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }
}
