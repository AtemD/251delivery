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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('discounts')->truncate();

        $shops = Shop::all();

        $shops->each(function($shop) {
            $random_num = mt_rand(0, 3);

            if($random_num > 0) {
                factory('App\Models\Discount', $random_num)->create([
                    'shop_id' => $shop->id,
                ]);
            }
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
