<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    // Rate types
    const PERCENTAGE_DISCOUNT = 'percentage';
    const CURRENCY_DISCOUNT = 'currency';

    // Discount Statuses
    const ENABLED_DISCOUNT = 'enabled';
    const DISABLED_DISCOUNT = 'disabled';

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'product_has_discount', 'discount_id', 'product_id');
    }
}
