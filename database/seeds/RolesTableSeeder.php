<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();

        $retailer_role = Role::create(['name' => 'retailer']);
        $admin_role = Role::create(['name' => 'admin']);

        // Admin permissions
        $admin_permissions = Permission::create(['name' => 'create roles']);
        $admin_permissions = Permission::create(['name' => 'edit roles']);
        $admin_permissions = Permission::create(['name' => 'delete roles']);
        $admin_permissions = Permission::create(['name' => 'view roles']);

        // Retailer Permissions
        $retailer_permissions = Permission::create(['name' => 'create products']);
        $retailer_permissions = Permission::create(['name' => 'edit products']);
        $retailer_permissions = Permission::create(['name' => 'delete products']);
        $retailer_permissions = Permission::create(['name' => 'view products']);

        // Sync multiple permission to a role
        $retailer_role->syncPermissions($admin_permissions);
        $admin_role->syncPermissions($retailer_permissions);

        // Get the first 5 users and assign them roles
        $users = User::limit(5)->get();

        $users->each(function($user) use($retailer_role, $admin_role){
            $random_num = mt_rand(1, 2);

            if($random_num === 1){
                $user->assignRole($retailer_role);
            }else{
                $user->assignRole($admin_role);
            }
            
        });

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
