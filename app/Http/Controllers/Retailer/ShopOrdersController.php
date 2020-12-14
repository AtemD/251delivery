<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use App\Models\Order;
use App\Models\OrderType;
use App\Models\OrderStatus;
use App\Search\OrderSearch;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;

class ShopOrdersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\Shop $shop
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Shop $shop)
    {
        $this->authorize('view', $shop);
        $this->authorize('view', Order::class);

        $request->validate([
            'global_order_search' => 'min:3',
        ]);

        // Apply filters to ordes
        $orders = OrderSearch::apply($request);

        // Retrieve orders for the current shop
        $orders = $orders->where('shop_id', $shop->id)->with([
            'orderType',
            'paymentMethod',
            'orderStatus',
            'user',
        ])->orderBy('created_at', 'desc')->simplePaginate();

        $order_statuses = OrderStatus::all();
        $order_types = OrderType::all();
        $payment_methods = PaymentMethod::all();

        return view('dashboard/retailer/orders/index', compact(
            'shop',
            'orders',
            'order_statuses',
            'order_types',
            'payment_methods'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop $shop
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $shop, Product $product)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop $shop 
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $shop, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     *  @param \App\Models\Shop $shop
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop, Product $product)
    {
        //
    }
}
