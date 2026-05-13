<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowItem extends Model
{
    protected $guarded = [];

    public function borrow() {
        return $this->belongsTo(Borrow::class, 'borrow_id', 'id');
    }

    public function bookCopies() {
        return $this->belongsTo(BookCopies::class, 'book_copy_id', 'id');
    }

    public function fines() {
        return $this->hasMany(Fine::class, 'borrow_item_id', 'id');
    }
}
