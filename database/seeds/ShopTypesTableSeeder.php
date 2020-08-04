<?php

use Illuminate\Database\Seeder;

class ShopTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // e.g. Retaurants, Supermarkets, Bakeries, et.c
        factory(App\Models\ShopType::class, 3)->create();
    }
}
