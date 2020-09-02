<?php

namespace App\Models;

use App\User;
use App\Scopes\RetailerScope;

class Retailer extends User
{
    protected static function boot()
	{
		parent::boot();

		static::addGlobalScope(new RetailerScope);
    }
    
    public function shops()
    {
        return $this->belongsToMany('App\Models\Shop', 'shop_has_users', 'user_id', 'shop_id');
    }
}
