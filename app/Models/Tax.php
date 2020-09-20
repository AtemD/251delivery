<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    protected $fillable = [
        'name', 'rate', 'rate_type', 'shop_id', 'is_enabled'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'base_price' => 'integer',
    ];

    protected $appends = ['tax_rate'];

    // Rate types
    const PERCENTAGE_TAX = 'percentage';

    // tax Statuses
    const ENABLED_TAX = '1';
    const DISABLED_TAX = '0';

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_has_tax', 'tax_id', 'product_id');
    }

    /**
     * Get the tax rate.
     *
     * @return string
     */
    public function getTaxRateAttribute()
    {
        return $this->rate / 100;
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
