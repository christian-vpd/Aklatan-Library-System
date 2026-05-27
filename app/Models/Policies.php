<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Policies extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function categories() {
        return $this->belongsTo(PolicyCategories::class, 'policy_category_id', 'id');
    }
}
