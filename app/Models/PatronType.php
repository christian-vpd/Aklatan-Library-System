<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatronType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function patrons() {
        return $this->hasMany(Patron::class, 'patron_type_id');
    }

    public function addedBy() {
        return $this->belongsTo(User::class,'added_by');
    }
}
