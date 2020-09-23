<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'abbreviation', 'description', 'region_id', 'is_enabled'
    ];

    /**
     * Get the locations for the city
     */
    public function shopLocations()
    {
        return $this->hasMany('App\Models\ShopLocation');
    }

    /**
     * Get the region belonging to the city
     */
    public function region()
    {
        return $this->belongsTo('App\Models\Region');
    }
}
