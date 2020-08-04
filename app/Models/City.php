<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * Get the locations for the city
     */
    public function locations()
    {
        return $this->hasMany('App\Location');
    }

    /**
     * Get the region belonging to the city
     */
    public function region()
    {
        return $this->belongsTo('App\Region');
    }
}
