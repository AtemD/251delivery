<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use App\Scopes\NoficationScope;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Shop extends Model
{
    use Notifiable, HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description', 'email', 'phone_number', 
        'shop_type_id', 'banner_image', 'logo_image', 'average_preparation_time',
        'shop_account_status_id', 'is_available', 'status_by', 'status_date'
    ];

    // protected $guarded = [];

    // Account Statuses
    const VERIFIED_SHOP = 'verified';
    const UNVERIFIED_SHOP = 'unverified';
    const DEACTIVATED_SHOP = 'deactivated';

    // Availability Statuses
    const AVAILABLE_SHOP = 'available';
    const UNAVAILABLE_SHOP = 'unavailable';

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }
    
    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get a string path for the shop
     * 
     * @return string
     */
    public function path()
    {
        return "/shops/{$this->slug}";
    }

    /**
     * Get a string path for the shop
     * 
     * @return string
     */
    public function getBannerImagePathAttribute()
    {
        return "/uploads/shops/banner_images/large/{$this->banner_image}";
    }

    public function getSmallBannerImagePathAttribute()
    {
        return "/uploads/shops/banner_images/thumb/{$this->banner_image}";
    }

    public function getMinFoodPreparationTimeAttribute()
    {
        return collect(explode('-', $this->average_preparation_time))->first();
    }

    public function getMaxFoodPreparationTimeAttribute()
    {
        return collect(explode('-', $this->average_preparation_time))->last();
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
        return $this->belongsToMany('App\Models\Cuisine', 'shop_has_cuisines', 'shop_id', 'cuisine_id');
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

    public function shopType()
    {
        return $this->belongsTo('App\Models\ShopType');
    }

    public function shopAccountStatus()
    {
        return $this->belongsTo('App\Models\ShopAccountStatus');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function shopLocation()
    {
        return $this->hasOne('App\Models\ShopLocation');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'shop_has_users', 'shop_id', 'user_id');
    }

    /**
     * Scope a query to only include shops of a given status.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $shopStatus
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $shopStatus)
    {
        // dd('hit');
        return $query->whereHas('shopAccountStatus', function($query) use($shopStatus) {
                    $query->where('name', $shopStatus);
                    // $query->where('id', 1);
                });
    }

}
