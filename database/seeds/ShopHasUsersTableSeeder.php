<?php

use App\User;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopHasUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = Shop::all();
        $retailers = User::role('retailer')->get();

        $shops->each(function($shop) use($retailers){
            $retailers = $retailers->random(mt_rand(1, 4));
            $shop->retailers()->attach($retailers);
        });
    }
}
