<?php

namespace App\Http\Controllers\Company;

use App\Models\Order;
use App\Models\OrderType;
use App\Models\OrderStatus;
use App\Search\OrderSearch;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Authorize if the user is allowed to view orders 
        $this->authorize('viewAny', Order::class);

        // Apply the request shop filters
        $orders = OrderSearch::apply($request);

        $orders = $orders->with([
            'user',
            'orderType',
            'paymentMethod',
            'orderStatus',
        ])->simplePaginate();

        
        $order_statuses = OrderStatus::all();
        $order_types = OrderType::all();
        $payment_methods = PaymentMethod::all();

        return view('dashboard/company/orders/index', compact([
            'orders',
            'order_statuses',
            'order_types',
            'payment_methods'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
