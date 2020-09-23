<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopLocation extends Model
{

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
}
