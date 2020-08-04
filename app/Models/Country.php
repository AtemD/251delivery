<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    // Country status
    const ACTIVATED_COUNTRY = 'activated';
    const DEACTIVATED_COUNTRY = 'deactivated';

    /**
     * Get the cities for the country
     */
    public function regions()
    {
        return $this->hasMany('App\Region');
    }
}
