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
            $shop = \App\Models\Shop::findOrFail($order->shop_id);
            $products = $shop->products()->get();
            $random_products = $products->random(mt_rand(1, $products->count()));

            $order->products()->attach($random_products, [
                'quantity' => mt_rand(1, 4),
                'amount' => 30000,
                'special_request' => "this is my special request"
            ]);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
