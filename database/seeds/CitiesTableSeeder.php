<?php

use App\Models\Region;
use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve all the regions
        $regions = Region::all();

        // Foreach region assign several regions
        $regions->each(function($region) {
            $region->cities()->saveMany(factory(City::class, mt_rand(2, 6))->make([
                'region_id' => $region->id,
            ]));
        });
    }
}
