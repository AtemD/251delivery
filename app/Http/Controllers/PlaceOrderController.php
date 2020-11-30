<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Notifications\OrderPlaced;
use Illuminate\Support\Facades\DB;

class PlaceOrderController extends Controller
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
    public function store(Request $request)
    {
        $this->validate($request,[
            'city' => 'required|integer|exists:cities,id',
            'order_type' => 'required|integer|exists:order_types,id',
            'phone_number' => 'required|string',
            'delivery_address' => 'required|max:255',
            'payment_method' => 'required|integer|exists:payment_methods,id',
            // 'special_request' => 'nullable',
            'agreed_to_terms_and_conditions' => 'required|string',
        ]);
        // $shop = session()->get('cart.shop');
        // dd($shop->id);

        // process the payment method
        $chosen_payment_method = PaymentMethod::findOrFail($request->payment_method);

        // Make sure the payment method is enabled
        if(!$chosen_payment_method->is_enabled) {
            return back()->with('error', 'Invalid payment method');
        }

        // redirect the user to the payment page or appropriate website to process the payment
        if($chosen_payment_method->status === false) {
            return back()->with('error', 'Payment Method Not Allowed');
        }

        // Determine which payment method has been chosen.
        switch ($chosen_payment_method->name) {
            case PaymentMethod::CASH_ON_DELIVERY:

                $order_status = OrderStatus::where('name', OrderStatus::PENDING_ORDER)->firstOrFail();
                $order = \App\Models\Order::class; 

                if(session()->has('cart.products')) 
                {
                    $products = session()->get('cart.products');
                    $shop = session()->get('cart.shop');

                    DB::transaction(function() use($request, &$order, $shop, $order_status, $products, $chosen_payment_method){
                        
                        // generate order number or ID for the user
                        // make sure the generated order number is not in the database
                        $order_number = \Carbon\Carbon::now()->getPreciseTimestamp();

                        $order = \App\Models\Order::create([
                            'user_id' => auth()->user()->id,
                            'shop_id' => $shop->id,
                            'number' => $order_number,
                            'order_type_id' => $request->order_type,
                            'delivery_address' => $request->delivery_address, 
                            'special_requests' => $request->special_request,
                            'payment_method_id' => $chosen_payment_method->id,
                            'order_status_id' => $order_status->id,
                        ]);

                        if(isset($order)){
                            foreach($products as $product){
                                $order->products()->attach($product->id, [
                                    'quantity' => $product->quantity,
                                    'amount' => $product->amount,
                                ]);
                            }
                        }
                        
                    }, 3);

                    // run order event here
                    // send notifications to user and restaurant: SMS, EMAIL, etc
                    $shop = session()->get('cart.shop');
                    $shop = Shop::findOrFail($shop->id);

                    // Notify shop of the order;
                    $shop->notify(new OrderPlaced($order));

                    // Notify current logged in user of the order
                    // auth()->user()->notify(new OrderPlaced();)

                }
            break;

            case PaymentMethod::WALLET_251:
                dd('WALLET: ' . $chosen_payment_method->name);
            break;

            case PaymentMethod::HELLO_CASH: 
                dd('HELLO CASH: ' . $chosen_payment_method->name);
            break;

        }

        // Clear the order from the cart, 
        // in this way if the user accidentally or intentionally cannot place the order again by reloading the place order page or clicking the place order function
        session()->forget('cart');

        return redirect()->route('thank-you.index');
    }
}
