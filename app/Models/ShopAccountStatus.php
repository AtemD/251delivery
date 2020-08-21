<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopAccountStatus extends Model
{
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
