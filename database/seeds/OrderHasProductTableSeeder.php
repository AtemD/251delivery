<?php

use App\Models\Order;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class OrderHasProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = Order::all();
        $shops = Shop::all();

        $orders->each(function($order) use($shops){
            $shop = $shops->random();
            $products = $shop->products()->get();
            $random_products = $products->random(mt_rand(1, $products->count()));

            $order->products()->attach($random_products, [
                'quantity' => mt_rand(1, 4),
                'amount' => 30000,
                'special_request' => "this is my special request"
            ]);
        });

    }
}
