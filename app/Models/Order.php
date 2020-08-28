<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // protected $guarded = [];

    // Order Statuses
    const PENDING_ORDER = 'pending';
    const APPROVED_ORDER = 'approved';
    const READY_ORDER = 'ready';
    const DELIVERING_ORDER = 'delivering';
    const COMPLETED_ORDER = 'completed';
    const REJECTED_ORDER = 'rejected';
    const CANCELLED_ORDER = 'cancelled';

    /**
     * The buyer that owns the order.
     */
    public function buyer()
    {
        return $this->belongsTo('App\Models\Buyer');
    }

    /**
     * The order type that belongs to an order.
     */
    public function orderType()
    {
        return $this->belongsTo('App\Models\OrderType');
    }

    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function orderStatus()
    {
        return $this->belongsTo('App\Models\OrderStatus');
    }

    /**
     * The products that belong to an order.
     */
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'order_has_product', 'order_id', 'product_id')
            ->withPivot('quantity', 'amount', 'special_request')->withTimestamps();
    }
}
