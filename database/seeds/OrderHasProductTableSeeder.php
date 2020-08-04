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

        
        $orders->each(function($order) {
            $shops = Shop::random();
            $products = $shop->products()->get();

            $order->products()->attach($products->random(mt_rand(1, 8)));
        });

    }
}
