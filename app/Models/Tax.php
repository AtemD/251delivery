<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    // Rate types
    const PERCENTAGE_TAX = 'percentage';

    // tax Statuses
    const ENABLED_TAX = 'enabled';
    const DISABLED_TAX = 'disabled';

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_has_tax', 'tax_id', 'product_id');
    }
}
