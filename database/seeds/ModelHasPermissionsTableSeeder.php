<?php

use App\User;
use App\Models\Shop;
use App\Models\Permission;
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

        $random_user->givePermissionTo(Permission::ACCESS_RETAILER_DASHBOARD);
        $random_user->givePermissionTo(Permission::VIEW_PRODUCTS);

        $shop = Shop::first();
        $random_user->shops()->sync($shop);
        
    }
}
