<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopAccountStatus extends Model
{
    /**
     * Get the locations for the city
     */
    public function shops()
    {
        return $this->hasMany('App\Models\Shop');
    }
}
