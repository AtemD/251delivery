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
      DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      DB::table('shops')->truncate();

      $shop_types = ShopType::all();
      $shop_account_statuses = ShopAccountStatus::all();

      $shop_types->each(function($shop_type) use($shop_account_statuses){

        $random_number_of_shops = mt_rand(8, 25);

        for($i=0; $i<$random_number_of_shops; $i++){
          factory('App\Models\Shop')->create([
            'shop_type_id' => $shop_type->id,
            'shop_account_status_id' => $shop_account_statuses->random()->id,
          ]);
        }

      });

      DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
