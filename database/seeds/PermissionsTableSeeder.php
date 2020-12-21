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

        // Access dashboard permissions
        Permission::create(['name' => Permission::ACCESS_RETAILER_DASHBOARD]);
        Permission::create(['name' => Permission::ACCESS_ADMINISTRATOR_DASHBOARD]);
        Permission::create(['name' => Permission::ACCESS_RIDER_DASHBOARD]);
        
        // CRUD Permissions

        Permission::create(['name' => Permission::CREATE_PRODUCTS]);
        Permission::create(['name' => Permission::UPDATE_PRODUCTS]);
        Permission::create(['name' => Permission::DELETE_PRODUCTS]);
        Permission::create(['name' => Permission::VIEW_PRODUCTS]);

        Permission::create(['name' => Permission::CREATE_OPENING_HOURS]);
        Permission::create(['name' => Permission::UPDATE_OPENING_HOURS]);
        Permission::create(['name' => Permission::DELETE_OPENING_HOURS]);
        Permission::create(['name' => Permission::VIEW_OPENING_HOURS]);

        Permission::create(['name' => Permission::CREATE_SHOPS]);
        Permission::create(['name' => Permission::UPDATE_SHOPS]);
        Permission::create(['name' => Permission::DELETE_SHOPS]);
        Permission::create(['name' => Permission::VIEW_SHOPS]);

        Permission::create(['name' => Permission::CREATE_SECTIONS]);
        Permission::create(['name' => Permission::UPDATE_SECTIONS]);
        Permission::create(['name' => Permission::DELETE_SECTIONS]);
        Permission::create(['name' => Permission::VIEW_SECTIONS]);

        Permission::create(['name' => Permission::CREATE_TAXES]);
        Permission::create(['name' => Permission::UPDATE_TAXES]);
        Permission::create(['name' => Permission::DELETE_TAXES]);
        Permission::create(['name' => Permission::VIEW_TAXES]);

        Permission::create(['name' => Permission::CREATE_DISCOUNTS]);
        Permission::create(['name' => Permission::UPDATE_DISCOUNTS]);
        Permission::create(['name' => Permission::DELETE_DISCOUNTS]);
        Permission::create(['name' => Permission::VIEW_DISCOUNTS]);

        Permission::create(['name' => Permission::CREATE_CUISINES]);
        Permission::create(['name' => Permission::UPDATE_CUISINES]);
        Permission::create(['name' => Permission::DELETE_CUISINES]);
        Permission::create(['name' => Permission::VIEW_CUISINES]);

        Permission::create(['name' => Permission::CREATE_USERS]);
        Permission::create(['name' => Permission::UPDATE_USERS]);
        Permission::create(['name' => Permission::DELETE_USERS]);
        Permission::create(['name' => Permission::VIEW_USERS]);

        Permission::create(['name' => Permission::CREATE_ORDERS]);
        Permission::create(['name' => Permission::UPDATE_ORDERS]);
        Permission::create(['name' => Permission::DELETE_ORDERS]);
        Permission::create(['name' => Permission::VIEW_ORDERS]);

        Permission::create(['name' => Permission::CREATE_ORDER_STATUSES]);
        Permission::create(['name' => Permission::UPDATE_ORDER_STATUSES]);
        Permission::create(['name' => Permission::DELETE_ORDER_STATUSES]);
        Permission::create(['name' => Permission::VIEW_ORDER_STATUSES]);

        Permission::create(['name' => Permission::CREATE_SHOP_ACCOUNT_STATUSES]);
        Permission::create(['name' => Permission::UPDATE_SHOP_ACCOUNT_STATUSES]);
        Permission::create(['name' => Permission::DELETE_SHOP_ACCOUNT_STATUSES]);
        Permission::create(['name' => Permission::VIEW_SHOP_ACCOUNT_STATUSES]);

        Permission::create(['name' => Permission::CREATE_USER_ACCOUNT_STATUSES]);
        Permission::create(['name' => Permission::UPDATE_USER_ACCOUNT_STATUSES]);
        Permission::create(['name' => Permission::DELETE_USER_ACCOUNT_STATUSES]);
        Permission::create(['name' => Permission::VIEW_USER_ACCOUNT_STATUSES]);

        Permission::create(['name' => Permission::CREATE_SHOP_TYPES]);
        Permission::create(['name' => Permission::UPDATE_SHOP_TYPES]);
        Permission::create(['name' => Permission::DELETE_SHOP_TYPES]);
        Permission::create(['name' => Permission::VIEW_SHOP_TYPES]);

        Permission::create(['name' => Permission::CREATE_ORDER_TYPES]);
        Permission::create(['name' => Permission::UPDATE_ORDER_TYPES]);
        Permission::create(['name' => Permission::DELETE_ORDER_TYPES]);
        Permission::create(['name' => Permission::VIEW_ORDER_TYPES]);

        Permission::create(['name' => Permission::CREATE_PAYMENT_METHODS]);
        Permission::create(['name' => Permission::UPDATE_PAYMENT_METHODS]);
        Permission::create(['name' => Permission::DELETE_PAYMENT_METHODS]);
        Permission::create(['name' => Permission::VIEW_PAYMENT_METHODS]);

        Permission::create(['name' => Permission::CREATE_COUNTRIES]);
        Permission::create(['name' => Permission::UPDATE_COUNTRIES]);
        Permission::create(['name' => Permission::DELETE_COUNTRIES]);
        Permission::create(['name' => Permission::VIEW_COUNTRIES]);

        Permission::create(['name' => Permission::CREATE_REGIONS]);
        Permission::create(['name' => Permission::UPDATE_REGIONS]);
        Permission::create(['name' => Permission::DELETE_REGIONS]);
        Permission::create(['name' => Permission::VIEW_REGIONS]);

        Permission::create(['name' => Permission::CREATE_CITIES]);
        Permission::create(['name' => Permission::UPDATE_CITIES]);
        Permission::create(['name' => Permission::DELETE_CITIES]);
        Permission::create(['name' => Permission::VIEW_CITIES]);

        Permission::create(['name' => Permission::CREATE_PERMISSIONS]);
        Permission::create(['name' => Permission::UPDATE_PERMISSIONS]);
        Permission::create(['name' => Permission::DELETE_PERMISSIONS]);
        Permission::create(['name' => Permission::VIEW_PERMISSIONS]);

        Permission::create(['name' => Permission::CREATE_ROLES]);
        Permission::create(['name' => Permission::UPDATE_ROLES]);
        Permission::create(['name' => Permission::DELETE_ROLES]);
        Permission::create(['name' => Permission::VIEW_ROLES]);

        Permission::create(['name' => Permission::CREATE_SHOP_LOCATIONS]);
        Permission::create(['name' => Permission::UPDATE_SHOP_LOCATIONS]);
        Permission::create(['name' => Permission::DELETE_SHOP_LOCATIONS]);
        Permission::create(['name' => Permission::VIEW_SHOP_LOCATIONS]);
        
        Permission::create(['name' => Permission::CREATE_E_WALLET_ACCOUNTS]);
        Permission::create(['name' => Permission::UPDATE_E_WALLET_ACCOUNTS]);
        Permission::create(['name' => Permission::DELETE_E_WALLET_ACCOUNTS]);
        Permission::create(['name' => Permission::VIEW_E_WALLET_ACCOUNTS]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
