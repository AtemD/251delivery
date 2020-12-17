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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('order_types')->truncate();

        factory(OrderType::class)->create([
            'name' => 'delivery',
            'description' => 'users order is delivered to their location',
        ]);

        factory(OrderType::class)->create([
            'name' => 'pickup',
            'description' => 'user picks up their order at the shop',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
