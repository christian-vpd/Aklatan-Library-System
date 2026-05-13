<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    //

    protected $guarded = [];

    public function patron() {
        return $this->belongsTo(Patron::class, 'patron_id', 'id');
    }

    public function bookCopy() {
        return $this->belongsTo(BookCopies::class, 'book_copy_id', 'id');
    }
}
