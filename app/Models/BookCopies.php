<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookCopies extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function borrowItem() {
        return $this->hasMany(BorrowItem::class, 'book_copy_id', 'id');
    }

    public function reservations() {
        return $this->hasMany(Reservation::class, 'book_copy_id', 'id');
    }
}
