<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    public function shops()
    {
        return $this->belongsToMany('App\Models\Shop', 'shop_has_cuisine', 'cuisine_id', 'shop_id');
    }
}
