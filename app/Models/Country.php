<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'abbreviation', 'currency_name', 'currency_abbreviation', 'is_enabled'
    ];

    // Country status
    const ACTIVATED_COUNTRY = 'activated';
    const DEACTIVATED_COUNTRY = 'deactivated';

    /**
     * Get the cities for the country
     */
    public function regions()
    {
        return $this->hasMany('App\Models\Region');
    }
}
