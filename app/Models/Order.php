<?php

namespace App\Models;

use App\Traits\Paginatable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Paginatable;

    // protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'user_id', 'shop_id', 'order_type_id', 'delivery_address', 'special_requests', 'payment_method_id', 'order_status_id', 'status_by', 'status_date'
    ];

    /**
     * The user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function shop()
    {
        return $this->belongsTo('App\Shop');
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
        return $this->belongsToMany('App\Models\Product', 'order_has_products', 'order_id', 'product_id')
            ->withPivot('quantity', 'amount', 'special_request')->withTimestamps();
    }
}
