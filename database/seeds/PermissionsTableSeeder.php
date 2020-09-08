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
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'edit products']);
        Permission::create(['name' => 'delete products']);
        Permission::create(['name' => 'view products']);

        Permission::create(['name' => 'create shops']);
        Permission::create(['name' => 'edit shops']);
        Permission::create(['name' => 'delete shops']);
        Permission::create(['name' => 'view shops']);

        Permission::create(['name' => 'access retailer dashboard']);


        // Admin permissions
        $admin_permissions = Permission::create(['name' => 'create roles']);
        $admin_permissions = Permission::create(['name' => 'edit roles']);
        $admin_permissions = Permission::create(['name' => 'delete roles']);
        $admin_permissions = Permission::create(['name' => 'view roles']);
        $admin_permissions = Permission::create(['name' => 'access administrator dashboard']);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
