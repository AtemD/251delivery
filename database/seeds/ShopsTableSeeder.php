<?php

use App\Models\ShopType;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shop_types = ShopType::all();
        $shop_class = Shop::class;

        $shop_types->each(function($shop_type) use($shop_class){
          factory($shop_class, mt_rand(4, 30))->create([
            'shop_type_id' => $shop_type->id,
          ]);
        });

    }
}
