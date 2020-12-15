<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Shop;
use App\Models\OrderType;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
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
    public function index()
    {
        // if there's no cart or the cart in the session is empty, return back with error.
        if (!session()->has('cart')) 
        return back()->with('error', 'Your cart is empty, please go back to shopping and create a new shopping cart.');
        
        // retrieve the items from the cart.
        $cart = session()->get('cart'); 

        // Delete the shop slug that was used to redirect the user here before login.
        if(session()->has('shop_slug')){
            session()->forget('shop_slug');
        }

        $cities = City::all();
        $payment_methods = PaymentMethod::all();
        $order_types = OrderType::all();
        $auth_user_location = Auth::user()->userLocation()->get()->first();
        $user_delivery_addresses = json_decode($auth_user_location->delivery_addresses);

        return view('checkout', compact([
            'cart',
            'cities',
            'payment_methods',
            'order_types',
            'auth_user_location', 
            'user_delivery_addresses'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the cart contents
        $this->validate($request,[
            'user_cart' => 'required|array',
        ]);

        // convert the user cart to a collection.
        $user_cart = collect($request->user_cart);

        $cart_product_ids = $user_cart->pluck('id');
        $cart_products_count = $cart_product_ids->count();

        // cart should have atleast 1 product
        if($cart_products_count < 1) return back()->with('error', 'Cart is empty, Please added products to cart');
        
        // Get the shop_id of the first product
        $shop = Shop::findOrFail($user_cart->first()['shop_id']);

        // Get all the shops products that the user ordered.
        $products = $shop->products()
            ->whereIn('id', $cart_product_ids)
            ->with(['taxes', 'discounts'])
            ->get();

        // check the count, to ensure no product was illegally added
        if($cart_products_count != $products->count()) {
            return back()->with('error', 'There was something wrong with your cart contents, remove them and add new ones');
        }

        // At this point we are sure all the products are from the same shop, and are not illegally added
        // Now we can build the cart array and store it in the session


        // Set the cart variables
        // All this in_the_cart values will be stored in cents
        $tax_to_put_in_the_cart = 0; 
        $discount_to_put_in_the_cart = 0;
        $tax_rate_to_put_in_the_cart = 0; // this value is a decimal, to 2 decimal places 
        $subtotal_to_put_in_the_cart = 0;
        $total_to_put_in_the_cart = 0;
        $total_products_to_put_in_the_cart = 0;
        $all_session_products_to_put_in_the_cart = [];

        $found_user_cart_product = [];
        $session_cart_product = collect();

        // foreach product calculate taxes and discounts
        foreach($products as $product) {
            
            // Search the user_cart for this product 
            foreach($user_cart as $user_cart_product){
                
                if($user_cart_product['id'] == $product->id){
                    $found_user_cart_product = $user_cart_product;
                    break;
                };
            }

            // If the product was found, then calculate its taxes and discounts
            if(!empty($found_user_cart_product)){
                // build the product into an array to store it in the session later.
                $session_cart_product = collect($found_user_cart_product)
                    ->only(['id', 'name', 'shop_id', 'shop_path', 'qty', 'base_price', 'modified_base_price']);

                // put taxes and discounts to this product to the session_cart_product
                $product_taxes = [];
                foreach($product->taxes as $tax) {
                    if(!empty($tax)){
                        array_push($product_taxes, $tax->only('name', 'rate', 'rate_type')); 
                    }
                }
                $session_cart_product->put('taxes', $product_taxes);

                $product_discounts = [];
                foreach($product->discounts as $discount){
                    if(!empty($discount)){
                        array_push($product_discounts, $discount->only('name', 'rate', 'rate_type'));
                    }
                }
                $session_cart_product->put('discounts', $product_discounts);

                // convert the product to array and push it into all_session_products_to_put_in_the_cart variable above
                array_push($all_session_products_to_put_in_the_cart, $session_cart_product->toArray());

                // First obtain the products quantity to get its total amount
                $total_product_amount = $session_cart_product['qty'] * $session_cart_product['base_price'];

                // update the variable of total products in the cart
                $total_products_to_put_in_the_cart = $total_products_to_put_in_the_cart + $session_cart_product['qty'];

                // update subtotal in cart
                $subtotal_to_put_in_the_cart = $subtotal_to_put_in_the_cart + $total_product_amount;

                // calculate the discounts
                // *Discount should be calculated before the tax, so that we can get the sum of discount we will use to subtract to get the actual tax of each product
                $sum_of_discounts_in_currency = 0;
                if(!empty($session_cart_product['discounts'])){
                    
                    $discount_in_percentage = 0;
                    $discount_in_currency = 0;

                    foreach($session_cart_product['discounts'] as $discount) {
                        // determine the discount rate and rate_type
                        if($discount['rate_type'] == 'percentage'){
                            $discount_in_percentage = $discount_in_percentage + $discount['rate']/100; // divide by 100 since the rate is stored in cents.
                        } else if($discount['rate_type'] == 'currency') {
                            $discount_in_currency = $discount_in_currency + $discount['rate']; // if it is in currency, do not divide it by 100.
                        }
                    }
                    
                    // Apply all the current given discounts to the product
                    $sum_of_discounts_in_currency = ($discount_in_currency * $session_cart_product['qty']) 
                        + (($discount_in_percentage / 100) * $total_product_amount);
                    // update the discounts to put in the cart
                    $discount_to_put_in_the_cart = $sum_of_discounts_in_currency;
                }


                // calculate the tax, it they are set for this product
                $tax_in_percentage = 0;
                if(!empty($session_cart_product['taxes'])){

                    foreach($session_cart_product['taxes'] as $tax) {
                        if($tax['rate_type'] == 'percentage'){
                            $tax_in_percentage = $tax_in_percentage + $tax['rate']/100;// divide by 100 since the rate is stored in cents
                        }
                    }
                }
                // store all the taxes that should be applied to the product
                // ...found by multiplying the  tax percentage with total product amount
                // remove the discount from the total product amount to get its correct tax
                $total_product_amount = $total_product_amount - $sum_of_discounts_in_currency; // discount remove first before getting tax
                $tax_to_put_in_the_cart = $tax_to_put_in_the_cart + (($tax_in_percentage / 100) * $total_product_amount);

                // Reset the session_cart_product
                $session_cart_product = collect();
            }
        
            // reset the found_user_cart_product
            $found_user_cart_product = [];
        }

        // Obtain the tax_rate
        // first deduct the discount from the subtotal to get the total after discount is removed
        // then caculate the tax rate applied
        $total_after_discount = $subtotal_to_put_in_the_cart - $discount_to_put_in_the_cart;
        $tax_rate_to_put_in_the_cart = ($tax_to_put_in_the_cart * 100) / $total_after_discount; // obtain rate to display in the customers receipt

        // update total in cart
        // ...done after subtracting the total tax and total discounts from the subtotal
        // should not be a value less than 0, make sure to do that check.
        // to get total, first remove the discount, then add the tax
        $total_to_put_in_the_cart = ($subtotal_to_put_in_the_cart - $discount_to_put_in_the_cart) + $tax_to_put_in_the_cart;

        if($total_to_put_in_the_cart < 0) {
            return back()->with('error', 'There was a problem with the total amount in cart');
        }

        // Put all the necessary values in the cart
        // Make sure to cast all the money, percentage or currency values to int
        session()->put('cart.products', $all_session_products_to_put_in_the_cart);
        session()->put('cart.tax', (int)$tax_to_put_in_the_cart);
        session()->put('cart.discount', (int)$discount_to_put_in_the_cart);
        session()->put('cart.total_products', (int)$total_products_to_put_in_the_cart);
        session()->put('cart.subtotal', (int)$subtotal_to_put_in_the_cart);
        session()->put('cart.total', (int)$total_to_put_in_the_cart);

        // tax rate is a decimal, round it to 2 decimal places before inserting it into the cart.
        $tax_rate_to_put_in_the_cart = round($tax_rate_to_put_in_the_cart, 2);
        session()->put('cart.tax_rate', $tax_rate_to_put_in_the_cart); 

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Cart Verified Successfully']);
        }
        
        return redirect()->route('checkout.index');
    }
}
