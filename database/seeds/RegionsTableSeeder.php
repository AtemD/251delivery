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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('regions')->truncate();

        // Retrieve all the countries
        $countries = Country::all();

        // Foreach country assign several regions
        $countries->each(function($country) {
            $country->regions()->saveMany(factory(App\Models\Region::class, mt_rand(2, 3))->make([
                'country_id' => $country->id,
            ]));
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
