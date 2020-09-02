<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('roles')->truncate();

        $retailer_role = Role::create(['name' => 'retailer']);
        $admin_role = Role::create(['name' => 'administrator']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
