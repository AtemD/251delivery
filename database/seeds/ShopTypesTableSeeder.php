<?php

use App\Models\ShopType;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('shop_types')->truncate();

        // e.g. Retaurants, Supermarkets, Bakeries, etc

        factory(ShopType::class)->create([
            'name' => 'restaurant',
            'description' => 'a restaurant shop',
        ]);

        factory(ShopType::class)->create([
            'name' => 'supermarket',
            'description' => 'a supermarket shop',
        ]);

        factory(ShopType::class)->create([
            'name' => 'bakery',
            'description' => 'a bakery shop',
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
