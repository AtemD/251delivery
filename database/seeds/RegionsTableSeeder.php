<?php

use App\Models\Country;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve all the countries
        $countries = Country::all();

        // Foreach country assign several regions
        $countries->each(function($country) {
            $country->regions()->saveMany(factory(App\Models\Region::class, mt_rand(3, 6))->make([
                'country_id' => $country->id,
            ]));
        });

    }
}
