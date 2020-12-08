<?php

use App\Models\Shop;
use App\Models\Cuisine;
use Illuminate\Database\Seeder;

class ShopHasCuisinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('shop_has_cuisines')->truncate();

        $shops = Shop::all();
        $cuisines = Cuisine::all();

        $shops->each(function($shop) use($cuisines){
            $shop->cuisines()->attach($cuisines->random(mt_rand(1, 2)));
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
