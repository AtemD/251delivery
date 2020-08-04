<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    // Region status
    const ACTIVATED_REGION = 'activated';
    const DEACTIVATED_REGION = 'deactivated';
    
    /**
     * Get country of the region
     */
    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    /**
     * Get cities of the region
     */
    public function cities()
    {
        return $this->hasMany('App\City');
    }
}
