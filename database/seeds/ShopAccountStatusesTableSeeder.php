<?php

use Illuminate\Database\Seeder;

class ShopAccountStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // e.g. Retaurants, Supermarkets, Bakeries, et.c
        factory(App\Models\ShopAccountStatus::class, 4)->create();
    }
}
