<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

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
        Permission::create(['name' => Permission::CREATE_PRODUCTS]);
        Permission::create(['name' => Permission::UPDATE_PRODUCTS]);
        Permission::create(['name' => Permission::DELETE_PRODUCTS]);
        Permission::create(['name' => Permission::VIEW_PRODUCTS]);

        Permission::create(['name' => Permission::CREATE_SHOPS]);
        Permission::create(['name' => Permission::UPDATE_SHOPS]);
        Permission::create(['name' => Permission::DELETE_SHOPS]);
        Permission::create(['name' => Permission::VIEW_SHOPS]);

        Permission::create(['name' => Permission::CREATE_SECTIONS]);
        Permission::create(['name' => Permission::UPDATE_SECTIONS]);
        Permission::create(['name' => Permission::DELETE_SECTIONS]);
        Permission::create(['name' => Permission::VIEW_SECTIONS]);

        Permission::create(['name' => Permission::ACCESS_RETAILER_DASHBOARD]);


        // Admin permissions
        Permission::create(['name' => Permission::CREATE_ROLES]);
        Permission::create(['name' => Permission::UPDATE_ROLES]);
        Permission::create(['name' => Permission::DELETE_ROLES]);
        Permission::create(['name' => Permission::VIEW_ROLES]);


        Permission::create(['name' => Permission::ACCESS_ADMINISTRATOR_DASHBOARD]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
