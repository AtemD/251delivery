<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'is_enabled'
    ];
    
    public function shops()
    {
        return $this->hasMany('App\Models\Shop');
    }
}
