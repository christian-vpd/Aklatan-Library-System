<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function category() {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    public function bookAuthor() {
        return $this->hasMany(BookAuthor::class, 'book_id', 'id');
    }

    public function copies()
    {
        return $this->hasMany(BookCopies::class, 'book_id', 'id');
    }

}
