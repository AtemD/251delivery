<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'abbreviation', 'country_id', 'is_enabled'
    ];

    // Region status
    const ACTIVATED_REGION = 'activated';
    const DEACTIVATED_REGION = 'deactivated';
    
    /**
     * Get country of the region
     */
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

    /**
     * Get cities of the region
     */
    public function cities()
    {
        return $this->hasMany('App\Models\City');
    }
}
