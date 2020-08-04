<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{

    protected $guarded = [];

    // Account Statuses
    const VERIFIED_SHOP = 'verified';
    const UNVERIFIED_SHOP = 'unverified';
    const DEACTIVATED_SHOP = 'deactivated';

    // Availability Statuses
    const AVAILABLE_SHOP = 'available';
    const UNAVAILABLE_SHOP = 'unavailable';

    /**
     * Get a string path for the shop
     * 
     * @return string
     */
    public function path()
    {
        return "/shops/{$this->id}";
    }

    public function isVerified()
    {
        return $this->account_status == Shop::VERIFIED_SHOP;
    }

    public function isDeactivated()
    {
        return $this->account_status == Shop::DEACTIVATED_SHOP;
    }

    public function isAvailable()
    {
        return $this->availability_status == Shop::AVAILABLE_SHOP;
    }

    public function cuisines()
    {
        return $this->belongsToMany('App\Models\Cuisine', 'shop_has_cuisine', 'shop_id', 'cuisine_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function sections()
    {
        return $this->hasMany('App\Models\Section');
    }

    public function taxes()
    {
        return $this->hasMany('App\Models\Tax');
    }

    public function discounts()
    {
        return $this->hasMany('App\Models\Discount');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function shopType()
    {
        return $this->belongsTo('App\Models\ShopType');
    }

    public function location()
    {
        return $this->morphOne('App\Models\Location', 'locationable');
    }

}
