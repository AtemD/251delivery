<?php

use App\User;
use App\Models\Shop;
use App\Models\City;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $location = Location::class;

        // Fetch all cities
        $cities = City::all();

        // Fetch all the shops
        $shops = Shop::all();

        // Fectch all the users
        $users = User::all();

        // Give each shop a location
        $shops->each(function($shop) use ($cities, $faker, $location) {
            factory($location)->create([
                'city_id' => $cities->random()->id,
                'locationable_id' =>$shop->id,
                'locationable_type' =>'shops',
            ]);
        });

        // Give each user a location
        $users->each(function($user) use ($cities, $faker, $location) {
            factory($location)->create([
                'city_id' => $cities->random()->id,
                'locationable_id' =>$user->id,
                'locationable_type' =>'users',
            ]);
        });
    }
}
