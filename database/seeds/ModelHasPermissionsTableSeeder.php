<?php

use App\User;
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
        $random_user = User::doesntHave('roles')->get();

        $random_user->random()->givePermissionTo('view products');
    }
}
