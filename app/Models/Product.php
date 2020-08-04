<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'status', 'shop_id', 'section_id', 'image', 'description', 'base_price'
    ];

    // Account Statuses
    const AVAILABLE_PRODUCT = 'available';
    const UNAVAILABLE_PRODUCT = 'unavailable';

    protected $appends = ['price', 'image_path'];

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

    public function getPriceAttribute() :float
    {
        return $this->base_price / 100;
    }

    public function getImagePathAttribute() :string
    {
        return "/uploads/shops/products/{$this->image}";
    }
}
