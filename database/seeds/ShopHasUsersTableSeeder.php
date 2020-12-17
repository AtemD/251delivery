<?php

use App\User;
use App\Models\Role;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopHasUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('shop_has_users')->truncate();

        $shops = Shop::all();
        $retailers = User::role(Role::RETAILER)->get();

        $shops->each(function($shop) use($retailers){
            $retailers = $retailers->random(mt_rand(1, 4));
            $shop->users()->attach($retailers);
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
