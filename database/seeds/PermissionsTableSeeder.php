<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
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

        DB::table('permissions')->truncate();
        
        // Retailer Permissions
        $retailer_permissions = Permission::create(['name' => 'create products']);
        $retailer_permissions = Permission::create(['name' => 'edit products']);
        $retailer_permissions = Permission::create(['name' => 'delete products']);
        $retailer_permissions = Permission::create(['name' => 'view products']);


        // Admin permissions
        $admin_permissions = Permission::create(['name' => 'create roles']);
        $admin_permissions = Permission::create(['name' => 'edit roles']);
        $admin_permissions = Permission::create(['name' => 'delete roles']);
        $admin_permissions = Permission::create(['name' => 'view roles']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
