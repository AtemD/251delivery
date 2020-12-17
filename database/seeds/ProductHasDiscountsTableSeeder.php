<?php

use App\Models\Shop;
use Illuminate\Database\Seeder;

class ProductHasDiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('product_has_discounts')->truncate();

        $shops = Shop::all();

        $shops->each(function($shop) {
            // Get the products and discounts for the current shop
            $products = $shop->products()->get();
            $discounts = $shop->discounts()->get();

            // Create between 0 or more discounts for the product
            $products->each(function($product) use($discounts){
                $discounts_count = $discounts->count();

                if($discounts_count > 0){
                    // create 0 or more discounts for the current product
                    $random_num = mt_rand(0, $discounts_count);

                    if($random_num > 0){
                        $product->discounts()->attach($discounts->random($random_num));
                    }
                }
            });
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
