<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    // Order Statuses
    const PENDING_ORDER = 'pending';
    const APPROVED_ORDER = 'approved';
    const READY_ORDER = 'ready';
    const DELIVERING_ORDER = 'delivering';
    const COMPLETED_ORDER = 'completed';
    const REJECTED_ORDER = 'rejected';
    const CANCELLED_ORDER = 'cancelled';
    
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
