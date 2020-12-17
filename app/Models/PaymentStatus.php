<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    const PENDING_PAYMENT = 'pending';
    const PAID_PAYMENT = 'paid';
    const REFUNDED_PAYMENT = 'refunded';
    const REQUEST_REFUND_PAYMENT = 'request refund';
    
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

    public function earningsReport()
    {
        $this->hasMany('App\Models\EarningReport');
    }
}
