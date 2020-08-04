<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /**
     * Get all of the owning locationable models
     */
    public function locationable()
    {
        return $this->morphTo();
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }
}
