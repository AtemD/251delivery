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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('cuisines')->truncate();

        factory(Cuisine::class)->create([
            'name' => 'Ethiopian',
            'description' => 'Ethiopian style meals',
        ]);

        factory(Cuisine::class)->create([
            'name' => 'Italian',
            'description' => 'Italian style meals',
        ]);

        factory(Cuisine::class)->create([
            'name' => 'Burger',
            'description' => 'Burger style meals',
        ]);

        factory(Cuisine::class)->create([
            'name' => 'Asian',
            'description' => 'Asian style meals',
        ]);

        factory(Cuisine::class)->create([
            'name' => 'Fasting',
            'description' => 'Fasting style meals',
        ]);

        factory(Cuisine::class)->create([
            'name' => 'Pizza',
            'description' => 'Pizza style meals',
        ]);

        factory(Cuisine::class)->create([
            'name' => 'Indian',
            'description' => 'Indian style meals',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
