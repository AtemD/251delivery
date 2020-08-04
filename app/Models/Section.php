<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }
}
