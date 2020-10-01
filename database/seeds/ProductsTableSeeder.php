<?php

use App\Models\Shop;
use App\Models\Cuisine;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
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
            // Get all the sections of the current shop
            $sections = $shop->sections()->get();

            // Give each section one or more products
            $sections->each(function($section) use($shop){
                factory('App\Models\Product', mt_rand(1, 8))->create([
                    'shop_id' => $shop->id,
                    'section_id' => $section
                ]);
            });
            
        });
        
    }
}
