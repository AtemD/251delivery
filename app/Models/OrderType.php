<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderType extends Model
{
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
