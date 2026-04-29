<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patron extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function type() {
        return $this->belongsTo(PatronType::class, 'patron_type', 'id');
    }
}
