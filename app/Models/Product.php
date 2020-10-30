<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'shop_id', 'section_id', 'image', 'description', 'base_price', 'is_available'
    ];

    // Account Statuses
    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    const PRODUCT_DEFAULT_IMAGE = 'product_default.jpg';

    protected $appends = ['status', 'image_path', 'short_description', 'base_price'];

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    public function taxes()
    {
        return $this->belongsToMany('App\Models\Tax', 'product_has_tax', 'product_id', 'tax_id');
    }

    public function discounts()
    {
        return $this->belongsToMany('App\Models\Discount', 'product_has_discount', 'product_id', 'discount_id');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order', 'order_has_product', 'product_id', 'order_id')
            ->withPivot('quantity', 'amount', 'special_request')->withTimestamps();;
    }

    public function getStatusAttribute()
    {
        return $this->is_available ? 'available' : 'unavailable';
    }

    /**
     * Get the base price.
     *
     * @return string
     */
    public function getBasePriceAttribute()
    {
        return $this->attributes['base_price'] / 100;
    }

    /**
     * Set the products base price.
     *
     * @param  string  $value
     * @return void
     */
    public function setBasePriceAttribute($value)
    {
        $this->attributes['base_price'] = $value * 100;
    }

    public function getImagePathAttribute()
    {
        return "/uploads/shops/products/thumbs/{$this->image}";
    }

    public function getShortDescriptionAttribute()
    {
        return mb_substr($this->description, 0,35);
    }
}
