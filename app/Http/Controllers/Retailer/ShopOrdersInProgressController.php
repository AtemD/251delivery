<?php

namespace App\Http\Controllers\Retailer;

use App\Models\Shop;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopOrdersInProgressController extends Controller
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
    public function index(Shop $shop)
    {
        $this->authorize('view', $shop);

        $this->authorize('view', Order::class);

        $approved_order = OrderStatus::where('name', Orderstatus::APPROVED_ORDER)->firstOrFail();

        $orders = $shop->orders()
            ->where('order_status_id', $approved_order->id)
            ->with([
                'orderStatus',
                'user',
                'products'
            ])->get();
            
        // dd($orders->toArray());

        return view('dashboard/retailer/orders/management/in-progress/index', compact(
            'shop',
            'orders',
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
