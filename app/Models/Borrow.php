<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrow extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function patrons() {
        return $this->belongsTo(Patron::class, 'patron_id', 'id');
    }

    public function librarians() {
        return $this->belongsTo(Librarian::class, 'librarian_id', 'id');
    }

    public function items() {
        return $this->hasMany(BorrowItem::class, 'borrow_id', 'id');
    }

}
