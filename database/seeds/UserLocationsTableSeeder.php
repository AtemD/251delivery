<?php

use App\User;
use App\Models\City;
use App\Models\UserLocation;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $location = UserLocation::class;

        // Fetch all cities
        $cities = City::all();

        // Fetch all the users
        $users = User::all();

        // Give each user a location
        $users->each(function($user) use ($cities, $faker, $location) {
            factory(\App\Models\UserLocation::class)->create([
                'city_id' => $cities->random()->id,
                'user_id' =>$user->id,
            ]);
        });
    }
}
