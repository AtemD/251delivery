<?php

use App\Models\Shop;
use Illuminate\Database\Seeder;

class DiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = Shop::all();

        $shops->each(function($shop) {
            $random_num = mt_rand(0, 3);

            if($random_num > 0) {
                factory('App\Models\Discount', $random_num)->create([
                    'shop_id' => $shop->id,
                ]);
            }
        });
    }
}
