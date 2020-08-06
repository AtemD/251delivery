<?php

use App\Models\Shop;
use App\Models\Cuisine;
use Illuminate\Database\Seeder;

class ShopHasCuisineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = Shop::all();
        $cuisines = Cuisine::all();

        $shops->each(function($shop) use($cuisines){
            $shop->cuisines()->attach($cuisines->random(mt_rand(1, 7)));
        });
    }
}
