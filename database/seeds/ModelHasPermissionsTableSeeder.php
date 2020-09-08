<?php

use App\User;
use App\Models\Shop;
use Illuminate\Database\Seeder;

class ModelHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::doesntHave('roles')->get();

        $random_user = $users->random();

        $random_user->givePermissionTo('access retailer dashboard');
        $random_user->givePermissionTo('view products');

        $shop = Shop::first();
        $random_user->shops()->sync($shop);
        
    }
}
