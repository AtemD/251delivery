<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPaymentStatus extends Model
{
    const PAID_ORDER = 'paid';
    const REQUEST_REFUND_ORDER = 'request refund';
    const REFUNDED_ORDER = 'refunded';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'color'
    ];

    public function orders()
    {
        $this->hasMany('App\Models\Order');
    }
}
