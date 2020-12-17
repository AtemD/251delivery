<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    // Order Statuses
    // const PENDING_ORDER = 'pending';
    // const APPROVED_ORDER = 'approved';
    const NEW_ORDER = 'new';
    const IN_PROGRESS_ORDER = 'in progress';
    const READY_ORDER = 'ready';
    const DELIVERING_ORDER = 'delivering';
    const COMPLETED_ORDER = 'completed';
    const REJECTED_ORDER = 'rejected'; // rejected by the restaurant/shop
    const CANCELLED_ORDER = 'cancelled'; // cancelled by the user who placed the order
    const EXPIRED_ORDER = 'expired'; // expired since it wasn't accepted withing time limit
    
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
