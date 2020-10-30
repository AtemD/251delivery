<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;

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
        if (!session()->has('cart')) return back()->with('error', 'Your Cart is Empty, Please Add Some Items and then Click Proceed to checkout button');

        $cart = session()->get('cart');

        $cities = City::all();
        $payment_methods = PaymentMethod::all();

        
        return view('checkout', compact([
            'cities',
            'payment_methods',
            'cart'
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

        $products = $shop->products()
            ->whereIn('id', $cart_product_ids)
            ->with(['taxes'])
            ->get();

        // check the count, to ensure no product was illegally added
        if($cart_products_count != $products->count()) return back()->with('error', 'There was something wrong with your cart contents');

        // At this point we are sure all the products are from the same shop, and are not illegally added

        // Place cart with its products and shop to the session
        $request->session()->put('cart.products');
        $request->session()->put('cart.shop', $shop);

        // Cart metadata
        $grand_total = 0;
        $total_items = 0;

        // for each product, get its user ordered quantity
        $products->each(function($product) use($user_cart, &$grand_total, &$total_items, $request) {

            // find the product in user cart 
            $current_user_cart_product = [];

            foreach($user_cart as $item){
                if($item['id'] == $product->id){
                    $current_user_cart_product = $item;
                    break;
                };
            }

            if(!empty($current_user_cart_product)) {

                // Give the product model instance an order quantity from the user cart.
                $product->ordered_qty = $current_user_cart_product['qty'];
                
                // Update the cart metadata
                $grand_total = $grand_total + ($product->base_price*$current_user_cart_product['qty']);
                $total_items = $total_items + $current_user_cart_product['qty'];

                
                // Push the products into the cart
                $request->session()->push('cart.products', $product);
            }

        });

        
        // Push the product meta data
        $request->session()->put('cart.grand_total', $grand_total);
        $request->session()->put('cart.total_items', $total_items);

        if (request()->expectsJson()) {
            return response([
                'code' => 200,
                'status' => 'Cart Verified Successfully']);
        }
        
        return redirect()->route('checkout.index');
    }
}
