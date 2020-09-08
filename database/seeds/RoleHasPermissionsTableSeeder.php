<?php

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
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

        DB::table('role_has_permissions')->truncate();

        $retailer_role = Role::where('name', Role::RETAILER)->first();
        $admin_role = Role::where('name', Role::ADMINISTRATOR)->first();
        $permissions = Permission::all();

        $retailer_role->syncPermissions([
            Permission::ACCESS_RETAILER_DASHBOARD,
            Permission::CREATE_PRODUCTS,
            Permission::UPDATE_PRODUCTS,
            Permission::DELETE_PRODUCTS,
            Permission::VIEW_PRODUCTS,

            Permission::CREATE_SHOPS,
            Permission::UPDATE_SHOPS,
            Permission::DELETE_SHOPS,
            Permission::VIEW_SHOPS,

            Permission::CREATE_SECTIONS,
            Permission::UPDATE_SECTIONS,
            Permission::DELETE_SECTIONS,
            Permission::VIEW_SECTIONS,
        ]);
        
        $admin_role->syncPermissions($permissions);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
