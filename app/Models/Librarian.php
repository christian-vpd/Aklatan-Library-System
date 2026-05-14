<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Librarian extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function borrow() {
        return $this->hasMany(Borrow::class, 'borrow_id', 'id');
    }

    public function announcement() {
        return $this->hasMany(Announcement::class, 'librarian_id', 'id');
    }
}
