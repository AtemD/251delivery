<?php

use Illuminate\Database\Seeder;

class UserAccountStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // e.g. Retaurants, Supermarkets, Bakeries, et.c
        factory(App\Models\UserAccountStatus::class, 4)->create();
    }
}
