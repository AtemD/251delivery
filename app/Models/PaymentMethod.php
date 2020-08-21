<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'is_enabled'
    ];
    
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
