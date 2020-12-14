<?php

use App\Models\Order;
use App\Models\Shop;
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
            // $shop = $shops->random();

            // Get the shop linked to this order
            $shop = \App\Models\Shop::findOrFail($order->shop_id);

            // Get all the products of this shop, with their taxes and discounts
            $products = $shop->products()->with([
                'taxes',
                'discounts'
            ])->get();

            // dd($products->first()->toArray());
            
            // Get a random number of products
            $random_products = $products->random(mt_rand(1, $products->count()));

            // get the tax of each random product
            $order->products()->attach($random_products, [
                'quantity' => mt_rand(1, 4),
                'amount' => 30000,
                'taxes' => json_encode([
                    ['rate'=>15,
                    'rate_type'=>'percentage'],
                    ['rate'=>10,
                    'rate_type'=>'percentage'],
                ]),
                'discounts' => json_encode([
                    ['rate'=>8,
                    'rate_type'=>'percentage'],
                    ['rate'=>5,
                    'rate_type'=>'amount'],
                ]),
                'special_request' => "this is my special request"
            ]);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
