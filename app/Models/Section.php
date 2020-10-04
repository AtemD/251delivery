<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'shop_id'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function shop()
    {
        return $this->belongsTo('App\Models\Shop');
    }
}
