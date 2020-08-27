<?php

namespace App\Models;

use App\User;

class Buyer extends User
{
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
