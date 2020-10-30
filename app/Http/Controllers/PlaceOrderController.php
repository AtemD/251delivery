<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // dd($request->all());

        // Validate the request
        $this->validate($request,[
            'city' => 'required|integer|exists:cities,id',
            'phone_number' => 'required|string',
            'delivery_adddress' => 'required|string|max:255',
            'payment_methods' => 'required|integer|exists:payment_methods,id',
            'agreed_to_terms_and_conditions' => 'required|string',
        ]);

        // process the payment method
        $chosen_payment_method = PaymentMethod::findOrFail($request->payment_methods);
        dd($chosen_payment_method->toArray());

        // redirect the user to the payment page or appropriate website to process the payment

        // Once payment is complete

        // redirect to thank you page.


        // return view('checkout', compact([
        //     'cities',
        //     'payment_methods'
        // ]));
    }
}
