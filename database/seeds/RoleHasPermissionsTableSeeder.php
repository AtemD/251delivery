<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleHasPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $retailer_role = Role::where('name', 'retailer')->first();
        $admin_role = Role::where('name', 'administrator')->first();
        $permissions = Permission::all();

        $retailer_role->syncPermissions([
            'access retailer dashboard',
            'create products', 
            'edit products', 
            'delete products', 
            'view products'
        ]);
        
        $admin_role->syncPermissions($permissions);
    }
}
