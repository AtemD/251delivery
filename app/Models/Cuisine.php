<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
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
        return $this->belongsToMany('App\Models\Shop', 'shop_has_cuisines', 'cuisine_id', 'shop_id');
    }
}
