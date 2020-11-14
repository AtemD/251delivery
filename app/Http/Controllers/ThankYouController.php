<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;

class ThankYouController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the user last order of todays date and display it with a thank you message,
        // If no order made today, show the user a link to home page to place order.

        // Retrive the order from the database,
        $users_latest_order_today = Order::with('products')->where('user_id', auth()->user()->id)->whereDate('created_at', Carbon::today())->latest()->first();

        // dd($users_latest_order_today->toArray());
        // Delete the order in the session since it's not needed at this point of successful retrieval
        // $cart = session()->get('cart');

        // return redirect()->route('thank-you', compact('users_latest_order'));

        return view('thank-you', compact([
            'users_latest_order_today',
            // 'cart'
        ]));

    }
}
