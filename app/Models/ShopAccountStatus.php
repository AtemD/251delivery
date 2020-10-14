<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopAccountStatus extends Model
{
    // User account status
    const VERIFIED_SHOP = 'verified';
    const UNVERIFIED_SHOP = 'unverified';
    const SUSPENDED_SHOP = 'suspended';
    const DEACTIVATED_SHOP = 'deactivated';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'color'
    ];
    
    public function shops()
    {
        return $this->hasMany('App\Models\Shop');
    }
}
