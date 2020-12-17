<?php

use App\Models\Shop;
use Illuminate\Database\Seeder;

class ProductHasTaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('product_has_taxes')->truncate();

        $shops = Shop::all();

        $shops->each(function($shop) {
            // Get the products and taxes for the current shop
            $products = $shop->products()->get();
            $taxes = $shop->taxes()->get();

            // Create between 0 or more taxes for the product
            $products->each(function($product) use($taxes){
                $taxes_count = $taxes->count();

                if($taxes_count > 0){
                    // create 0 or more taxes for the current product
                    $random_num = mt_rand(0, $taxes_count);

                    if($random_num > 0){
                        $product->taxes()->attach($taxes->random($random_num));
                    }
                }
            });
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
