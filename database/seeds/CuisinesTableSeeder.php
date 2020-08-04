<?php

use App\Models\Cuisine;
use Illuminate\Database\Seeder;

class CuisinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Cuisine::class, 12)->create();
    }
}
