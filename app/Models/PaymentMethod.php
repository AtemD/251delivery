<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
     // Payment Methods 
     const CASH_ON_DELIVERY = 'cash on delivery';
     const E_WALLET = 'e-wallet';
     const CBE_BIRR = 'cbe-birr';
     const HELLO_CASH = 'hello cash';
     const M_BIRR = 'm-birr';

 
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
