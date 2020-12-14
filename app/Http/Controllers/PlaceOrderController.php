<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Notifications\OrderPlaced;
use Illuminate\Support\Facades\DB;
use App\Traits\EWalletAccountSecurityTrait;

class PlaceOrderController extends Controller
{
    use EWalletAccountSecurityTrait;
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
        // dd(session()->get('cart'));

        // process the payment method
        $chosen_payment_method = PaymentMethod::findOrFail($request->payment_method);

        // Make sure the payment method is enabled
        if(!$chosen_payment_method->is_enabled) {
            return back()->with('error', 'Invalid payment method');
        }

        
        // Ensure that there are products in the cart 
        if(!session()->has('cart.products')) return back()->with('errors', 'Something is wrong with the cart, please place a new order');

        // Retrieve the products and shop_id from the cart
        $products = session()->get('cart.products');
        $cart = session()->get('cart');
        $shop_id = $products[0]['shop_id']; 

        $order_status = OrderStatus::where('name', OrderStatus::PENDING_ORDER)->firstOrFail();

        // Determine which payment method has been chosen.
        switch ($chosen_payment_method->name) {
            case PaymentMethod::CASH_ON_DELIVERY:
                DB::transaction(function() use($request, $shop_id, $order_status, $products, $chosen_payment_method){
                    
                    // generate order number or ID for the user
                    // make sure the generated order number is not in the database,i.e is unique
                    $order_number = auth()->user()->id . \Carbon\Carbon::now()->timestamp;

                    $order = \App\Models\Order::create([
                        'user_id' => auth()->user()->id,
                        'shop_id' => $shop_id,
                        'number' => $order_number,
                        'order_type_id' => $request->order_type,
                        'delivery_address' => $request->delivery_address, 
                        'special_requests' => $request->special_request,
                        'payment_method_id' => $chosen_payment_method->id,
                        'order_status_id' => $order_status->id,
                    ]);

                    
                    if(isset($order)){
                        foreach($products as $product){
                            // Ensure that the products are still available,
                            // The shop may have made them unavailable before the user places the order
                            // if it is unavailable the transaction should end and notify the user.
                            $taxes = empty($product['taxes']) ? null : json_encode($product['taxes']); // only obtain the tax: id, rate, rate type and name
                            $discounts = empty($product['discounts']) ? null : json_encode($product['discounts']); // only obtain the discount: id, rate, rate type and name

                            $order->products()->attach($product['id'], [
                                'quantity' => $product['qty'],
                                'amount' => $product['qty'] * $product['base_price'],
                                'taxes' =>  $taxes,
                                'discounts' => $discounts
                            ]);
                        }
                    }

                    // run order event here
                    // send notifications to user and restaurant: SMS, EMAIL, etc
                
                    $shop = Shop::findOrFail($shop_id);

                    // Notify shop of the order;
                    $shop->notify(new OrderPlaced($order));

                    // Notify current logged in user of the order
                    // auth()->user()->notify(new OrderPlaced();)
                    
                    // Remove the items from the cart.
                    // session()->forget('cart');
                    
                }, 3);
            break;

            // Here we have to deduct the users e-wallet account by the order amount
            case PaymentMethod::E_WALLET:
            
                $authenticated_user = auth()->user();
                $authenticated_user = auth()->user()->load('EWalletAccount');

                // Ensure the user has a wallet account.
                if(empty($authenticated_user->EWalletAccount)) 
                return back()->with('error', 'You have no e-wallet account with us, please contact us for help.');

                // Ensure the wallet account has enough money to cover the cost of the order(equal to or greater than)
                // keep in mind cart_total is in cents also e_wallet account balance is in cents
                $cart_total  = session()->get('cart.total'); 
                if($authenticated_user->EWalletAccount->balance < $cart_total)
                return back()->with('error', 'Your e-wallect account balance, 
                    (' . $authenticated_user->EWalletAccount->modified_balance . ' ETB) 
                    is low for the current order. Adjust the order or top up your account.');

                // Check the Ewallet account state is 'active'
                if(!$this->EWalletAccountIsActive($authenticated_user->EWalletAccount)) 
                return back()->with('error', 'Your e-wallet account is currently not active, please contact us for help.');

                // Check the Ewallet account status is 'verified'
                if(!$this->EWalletAccountIsVerified($authenticated_user->EWalletAccount)) 
                return back()->with('error', 'Your e-wallet account is currently not verified, please contact us for help.');

                // Ensure that the e-wallet account is within acceptable range
                // send the modified account balance since this function converts it to cents for comparison with the ranges.
                if(!$this->EWalletAccountBalanceIsWithinRange($authenticated_user->EWalletAccount->modified_balance))
                return back()->with('error', 'There is an issue with your account balance, please contact us for help.');

                // After all the e-wallet account security checks pass, we can make the transaction.
                DB::transaction(function() use($request, $shop_id, $order_status, $products, $chosen_payment_method, $authenticated_user, $cart){
                        
                    // generate order number or ID for the user
                    // make sure the generated order number is not in the database,i.e is unique
                    $order_number = auth()->user()->id . \Carbon\Carbon::now()->timestamp;

                    $order = \App\Models\Order::create([
                        'user_id' => auth()->user()->id,
                        'shop_id' => $shop_id,
                        'number' => $order_number,
                        'order_type_id' => $request->order_type,
                        'delivery_address' => $request->delivery_address, 
                        'special_requests' => $request->special_request,
                        'payment_method_id' => $chosen_payment_method->id,
                        'order_status_id' => $order_status->id,
                    ]);

                    
                    if(isset($order)){
                        foreach($products as $product){
                            // Ensure that the products are still available,
                            // The shop may have made them unavailable before the user places the order
                            // if it is unavailable the transaction should end and notify the user.
                            $taxes = empty($product['taxes']) ? null : json_encode($product['taxes']); // only obtain the tax: id, rate, rate type and name
                            $discounts = empty($product['discounts']) ? null : json_encode($product['discounts']); // only obtain the discount: id, rate, rate type and name

                            $order->products()->attach($product['id'], [
                                'quantity' => $product['qty'],
                                'amount' => $product['qty'] * $product['base_price'],
                                'taxes' =>  $taxes,
                                'discounts' => $discounts
                            ]);
                        }
                    }

                    // Deduct the total amount of the order from the users e-wallet account
                    // All this values are in cents
                    // ***It's vital you cast the balance to an int
                    $new_account_balance = (int) ($authenticated_user->EWalletAccount->balance - $cart['total']);

                    // When inserting the accessor will multiply the value by 100
                    // Therefore the new_account_balance should be divided by 100, since the access will automatically convert it to cents
                    $new_account_balance = (int) ($new_account_balance / 100);
                    $authenticated_user->EWalletAccount->update([
                        'balance' => $new_account_balance
                    ]);

                    // run order event here
                    // send notifications to user and restaurant: SMS, EMAIL, etc
                
                    $shop = Shop::findOrFail($shop_id);

                    // Notify shop of the order;
                    $shop->notify(new OrderPlaced($order));

                    // Notify current logged in user of the order
                    // auth()->user()->notify(new OrderPlaced();)
                    
                    // Remove the items from the cart.
                    // session()->forget('cart');
                    
                }, 3);
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
