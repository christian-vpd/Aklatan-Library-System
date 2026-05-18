<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicyCategories extends Model
{
    protected $guarded = [];

    public function policies() {
        return $this->hasMany(Policies::class, 'policy_category_id'. 'id');
    }
}
