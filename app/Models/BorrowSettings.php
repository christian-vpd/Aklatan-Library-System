<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BorrowSettings extends Model
{
    //

    protected $guarded = [];

    public function patronType() {
        return $this->belongsTo(PatronType::class, 'patron_type_id', 'id');
    }
}
