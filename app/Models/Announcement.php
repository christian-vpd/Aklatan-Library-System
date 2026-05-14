<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    protected $guarded = [];

    public function librarian() {
        return $this->belongsTo(Librarian::class, 'librarian_id', 'id');
    }
}
