<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    // Currencies
    const ETHIOPIAN_BIRR = 'ethiopian birr';
    const SOUTH_SUDANESE_POUND = 'south sudanese pound';

    protected $fillable = [
        'id', 'name', 'abbreviation', 'is_enabled'
    ];

    public function eWalletAccount()
    {
        return $this->hasMany('App\Models\EWalletAccount');
    }

    // public function country()
    // {
    //     return $this->belongsTo('App\Models\Country');
    // }

}
