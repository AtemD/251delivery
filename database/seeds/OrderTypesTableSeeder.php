<?php

use App\Models\OrderType;
use Illuminate\Database\Seeder;

class OrderTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OrderType::class, 4)->create();
    }
}
