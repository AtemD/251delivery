<?php

use App\Models\ShopType;
use App\Models\Shop;
use App\Models\ShopAccountStatus;
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
        $shop_account_statuses = ShopAccountStatus::all();

        $shop_types->each(function($shop_type) use($shop_account_statuses){
          factory('App\Models\Shop', mt_rand(4, 30))->create([
            'shop_type_id' => $shop_type->id,
            'shop_account_status_id' => $shop_account_statuses->random()->id,
          ]);
        });

    }
}
