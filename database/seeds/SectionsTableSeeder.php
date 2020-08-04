<?php

use App\Models\Shop;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shops = Shop::all();

        $shops->each(function($shop) {
            factory('App\Models\Section', mt_rand(3, 13))->create([
                'shop_id' => $shop->id,
            ]);
        });
    }
}
