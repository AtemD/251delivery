<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = [
        'name', 'rate', 'rate_type', 'shop_id', 'is_enabled'
    ];

    protected $appends = ['modified_rate'];

    // Rate types
    const PERCENTAGE_DISCOUNT = 'percentage';
    const CURRENCY_DISCOUNT = 'currency'; // or money rate type

    // Discount Statuses
    const ENABLED_DISCOUNT = 'enabled';
    const DISABLED_DISCOUNT = 'disabled';

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_has_discount', 'discount_id', 'product_id');
    }

    /**
     * Get the tax rate.
     *
     * @return string
     */
    public function getModifiedRateAttribute()
    {
        return $this->attributes['rate'] / 100;
    }

    /**
     * Set the tax rate.
     *
     * @param  string  $value
     * @return void
     */
    public function setRateAttribute($value)
    {
        $this->attributes['rate'] = $value * 100;
    }
}
