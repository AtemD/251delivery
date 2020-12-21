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

        $super_admin_role = Role::where('name', Role::SUPER_ADMINISTRATOR)->first();
        $admin_role = Role::where('name', Role::ADMINISTRATOR)->first();
        $retailer_role = Role::where('name', Role::RETAILER)->first();
        $all_permissions = Permission::all();

        // Give the super administrator all permissions
        $super_admin_role->syncPermissions($all_permissions);

        // Give the admin all or some of the permissions
        $admin_role->syncPermissions($all_permissions);
        // But revoke some permissions for this admin user
        $admin_role->revokePermissionTo(Permission::CREATE_E_WALLET_ACCOUNTS);
        $admin_role->revokePermissionTo(Permission::UPDATE_E_WALLET_ACCOUNTS);
        $admin_role->revokePermissionTo(Permission::VIEW_E_WALLET_ACCOUNTS);
        $admin_role->revokePermissionTo(Permission::DELETE_E_WALLET_ACCOUNTS);

        // Give the retailer role some permissions
        $retailer_role->syncPermissions([
            Permission::ACCESS_RETAILER_DASHBOARD,

            Permission::CREATE_PRODUCTS,
            Permission::UPDATE_PRODUCTS,
            Permission::DELETE_PRODUCTS,
            Permission::VIEW_PRODUCTS,

            // Permission::CREATE_OPENING_HOURS,
            Permission::UPDATE_OPENING_HOURS,
            // Permission::DELETE_OPENING_HOURS,
            Permission::VIEW_OPENING_HOURS,

            Permission::CREATE_SHOPS,
            Permission::UPDATE_SHOPS,
            Permission::DELETE_SHOPS,
            Permission::VIEW_SHOPS,

            Permission::CREATE_SECTIONS,
            Permission::UPDATE_SECTIONS,
            Permission::DELETE_SECTIONS,
            Permission::VIEW_SECTIONS,

           Permission::CREATE_TAXES,
           Permission::UPDATE_TAXES,
           Permission::DELETE_TAXES,
           Permission::VIEW_TAXES,

           Permission::CREATE_DISCOUNTS,
           Permission::UPDATE_DISCOUNTS,
           Permission::DELETE_DISCOUNTS,
           Permission::VIEW_DISCOUNTS,

           Permission::CREATE_SHOP_LOCATIONS,
           Permission::UPDATE_SHOP_LOCATIONS,
         //   Permission::DELETE_SHOP_LOCATIONS,
           Permission::VIEW_SHOP_LOCATIONS,

        //    Permission::CREATE_CUISINES,
           Permission::UPDATE_CUISINES,
        //    Permission::DELETE_CUISINES,
           Permission::VIEW_CUISINES,

           Permission::CREATE_USERS,
           Permission::UPDATE_USERS,
           Permission::DELETE_USERS,
           Permission::VIEW_USERS,

        //    Permission::CREATE_ORDERS,
           Permission::UPDATE_ORDERS,
        //    Permission::DELETE_ORDERS,
           Permission::VIEW_ORDERS,

        //    Permission::CREATE_ORDER_STATUSES,
        //    Permission::UPDATE_ORDER_STATUSES,
        //    Permission::DELETE_ORDER_STATUSES,
           Permission::VIEW_ORDER_STATUSES,

        //    Permission::CREATE_SHOP_ACCOUNT_STATUSES,
        //    Permission::UPDATE_SHOP_ACCOUNT_STATUSES,
        //    Permission::DELETE_SHOP_ACCOUNT_STATUSES,
           Permission::VIEW_SHOP_ACCOUNT_STATUSES,

        //    Permission::CREATE_USER_ACCOUNT_STATUSES,
        //    Permission::UPDATE_USER_ACCOUNT_STATUSES,
        //    Permission::DELETE_USER_ACCOUNT_STATUSES,
        //    Permission::VIEW_USER_ACCOUNT_STATUSES,

        //    Permission::CREATE_SHOP_TYPES,
        //    Permission::UPDATE_SHOP_TYPES,
        //    Permission::DELETE_SHOP_TYPES,
           Permission::VIEW_SHOP_TYPES,

        //    Permission::CREATE_ORDER_TYPES,
        //    Permission::UPDATE_ORDER_TYPES,
        //    Permission::DELETE_ORDER_TYPES,
           Permission::VIEW_ORDER_TYPES,

        //    Permission::CREATE_PAYMENT_METHODS,
        //    Permission::UPDATE_PAYMENT_METHODS,
        //    Permission::DELETE_PAYMENT_METHODS,
           Permission::VIEW_PAYMENT_METHODS,

        //    Permission::CREATE_COUNTRIES,
        //    Permission::UPDATE_COUNTRIES,
        //    Permission::DELETE_COUNTRIES,
           Permission::VIEW_COUNTRIES,

        //    Permission::CREATE_REGIONS,
        //    Permission::UPDATE_REGIONS,
        //    Permission::DELETE_REGIONS,
           Permission::VIEW_REGIONS,

        //    Permission::CREATE_CITIES,
        //    Permission::UPDATE_CITIES,
        //    Permission::DELETE_CITIES,
           Permission::VIEW_CITIES,

        //    Permission::CREATE_PERMISSIONS,
           Permission::UPDATE_PERMISSIONS,
        //    Permission::DELETE_PERMISSIONS,
           Permission::VIEW_PERMISSIONS,

        //    Permission::CREATE_ROLES,
        //    Permission::UPDATE_ROLES,
        //    Permission::DELETE_ROLES,
           Permission::VIEW_ROLES,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
