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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('sections')->truncate();

        $shops = Shop::all();

        $shops->each(function($shop) {
            factory('App\Models\Section', mt_rand(3, 8))->create([
                'shop_id' => $shop->id,
            ]);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
