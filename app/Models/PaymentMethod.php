<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
     // Roles Permissions
     const CREATE_ROLES = 'create roles';
     const UPDATE_ROLES = 'update roles';
     const DELETE_ROLES = 'delete roles';
     const VIEW_ROLES = 'view roles';

     // Payment Methods 
     const CASH_ON_DELIVERY = 'cash on delivery';
     const WALLET_251 = 'wallet-251';
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
