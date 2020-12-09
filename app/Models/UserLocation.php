<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id', 'postal_code', 'street', 'building', 'specific_information', 'address', 
        'delivery_addresses', 'user_id',
    ];

    // protected $appends = ['delivery_addresses'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    // public function getDeliveryAddressesAttribute()
    // {
    //     return json_decode($this->attribute['delivery_addresses']);
    // }
}
