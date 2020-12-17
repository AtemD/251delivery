<?php

use Carbon\Carbon;
use App\Models\Shop;
use App\Models\Order;
use App\Models\PaymentStatus;
use Illuminate\Database\Seeder;

class OrderHasProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('order_has_products')->truncate();

        $orders = Order::all();
        // $shops = Shop::all();

        $orders->each(function($order){
            // Get the shop linked to this order
            $shop = \App\Models\Shop::findOrFail($order->shop_id);

            // Get all the products of this shop, with their taxes and discounts
            $products = $shop->products()->with([
                'taxes',
                'discounts'
            ])->get();
            
            // Get a random number of products
            $random_products = $products->random(mt_rand(1, ($products->count() > 3) ? 3 : $products->count()));

            // The cart, to store cart details
            $order_cart = [];
            $order_cart['products'] = [];
            $order_cart['tax'] = 0;
            $order_cart['discount'] = 0;
            $order_cart['subtotal'] = 0;
            $order_cart['total'] = 0;
            $order_cart['items'] = 0;

            foreach($random_products as $product){ 
                // Get a random order quantity for this product.
                $product_quantity_ordered = mt_rand(1, 4);
                $product_amount = $product->base_price * $product_quantity_ordered;

                // update the cart items
                $order_cart['items'] = $order_cart['items'] + $product_quantity_ordered;
                // update the cart subtotal
                $order_cart['subtotal'] = $order_cart['subtotal'] + $product_amount;

                // Push this product into the products of the cart.
                $product_in_array_form = $product->only('id', 'name', 'base_price', 'modified_base_price', 'shop_id'); //->toArray();
                
                $product_in_array_form['qty'] = $product_quantity_ordered;

                // foreach product, calculate its taxes and discounts
                $product_array = []; // will contain its taxes and discounts
                $product_taxes_array = [];
                $product_discounts_array = [];

                // calculate its taxes
                foreach($product->taxes as $tax){
                    if(!empty($tax)){
                        array_push($product_taxes_array, $tax->only('name', 'rate', 'rate_type')); 
                        $tax_rate = $tax->rate / 100; // since it was stored in cents in integer form

                        if($tax->rate_type == 'percentage'){
                            $order_cart['tax'] = (int) ($order_cart['tax'] + (($tax_rate / 100) * $product_amount));
                        }
                    } 
                }
                // push the taxes to the products array
                $product_in_array_form['taxes'] = $product_taxes_array;

                // calculate its discounts
                foreach($product->discounts as $discount){
                    if(!empty($discount)){
                        array_push($product_discounts_array, $discount->only('name', 'rate', 'rate_type'));
                        $discount_rate = $discount->rate / 100; // since it was stored in cent, it could be of type percentage or currency

                        if($discount->rate_type == 'percentage'){
                            $order_cart['discount'] = (int) ($order_cart['discount'] + (($discount_rate/100) * $product_amount));
                        } else if($discount->rate_type == 'currency'){
                            // convert the discount rate back to cents as the order_cart discount is in cents
                            // the product discount rate should be also multiplied by its quantity, to get the right discount amount
                            $order_cart['discount'] = (int) ($order_cart['discount'] +   ($discount_rate * 100 * $product_quantity_ordered) ); 
                        }
                    }
                }
                // push the discounts to the products array
                $product_in_array_form['discounts'] = $product_discounts_array;

                // Store the products with all its taxes and discounts in the cart array
                array_push($order_cart['products'], $product_in_array_form);

                // Update the order has products table
                // get the tax of each random product
                $order->products()->attach($product, [
                    'quantity' => $product_quantity_ordered,
                    'amount' => $product_amount,
                    'taxes' => (!empty($product_taxes_array)) ? json_encode([$product_taxes_array]) : null,
                    'discounts' => (!empty($product_discounts_array)) ? json_encode([$product_discounts_array]) : null,
                    'special_request' => "this is my special request"
                ]);

            }

            // update the cart total, by removing the discount, then adding the tax
            $order_cart['total'] = ($order_cart['subtotal'] - $order_cart['discount']) + $order_cart['tax'];

            // Update this orders table
            // update some essential columns to realistic values.
            $payment_statuses = PaymentStatus::all()->pluck('id');

            // Set a random time the order was placed
            // e.g time within the last hour
            $year = 2020; // this year
            $month = 12; // this month
            $date = 17; // this day
            $hours = mt_rand(0, 23); // between 00hrs and 23hrs
            $mins = mt_rand(0, 59); // between 0 and 59
            $secs = mt_rand(0, 59);
            $random_date_and_time = Carbon::create($year, $month, $date, $hours, $mins, $secs);

            $order->update([
                'cart' => $order_cart,
                'payment_status_id' => $payment_statuses->random(),
                'created_at' => $random_date_and_time,
            ]);

            // ***try seeding today, within the last 3 or 5 mins, to see if the scheduler will change the status to expired
            // columns: payment_status, created_at, updated_at
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
