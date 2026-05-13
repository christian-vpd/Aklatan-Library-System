<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fine extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function patron() {
        return $this->belongsTo(Patron::class, 'patron_id', 'id');
    }

    public function borrowItems() {
        return $this->belongsTo(Borrow::class, 'borrow_item_id', 'id');
    }
}
