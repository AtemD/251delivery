<?php

namespace App\Models;

use App\User;
use App\Scopes\AdministratorScope;

class Administrator extends User
{
    protected static function boot()
	{
		parent::boot();

		static::addGlobalScope(new AdministratorScope);
    }
    
    public function shops()
    {
        return $this->belongsToMany('App\Models\Shop', 'shop_has_users', 'user_id', 'shop_id');
    }
}
