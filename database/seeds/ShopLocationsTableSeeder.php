<?php

use App\Models\Shop;
use App\Models\City;
use App\Models\ShopLocation;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ShopLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('shop_locations')->truncate();

        $faker = Faker::create();

        $location = ShopLocation::class;

        // Fetch all cities
        $cities = City::all();

        // Fetch all the shops
        $shops = Shop::all();

        // Give each shop a location
        $shops->each(function($shop) use ($cities, $faker, $location) {
            factory(\App\Models\ShopLocation::class)->create([
                'city_id' => $cities->random()->id,
                'shop_id' =>$shop->id,
            ]);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
