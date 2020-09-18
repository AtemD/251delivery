<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    // Roles Permissions
    const CREATE_ROLES = 'create roles';
    const UPDATE_ROLES = 'update roles';
    const DELETE_ROLES = 'delete roles';
    const VIEW_ROLES = 'view roles';

    // Permissions Permissions
    const CREATE_PERMISSIONS = 'create permissions';
    const UPDATE_PERMISSIONS = 'update permissions';
    const DELETE_PERMISSIONS = 'delete permissions';
    const VIEW_PERMISSIONS = 'view permissions';

    // Access Routes, used to redirect users appropriately
    const ACCESS_ADMINISTRATOR_DASHBOARD = 'access administrator dashboard';
    const ACCESS_RETAILER_DASHBOARD = 'access retailer dashboard';
    const ACCESS_RIDER_DASHBOARD = 'access rider dashboard';

    // Shop Permissions
    const CREATE_SHOPS = 'create shops';
    const UPDATE_SHOPS = 'update shops';
    const DELETE_SHOPS = 'delete shops';
    const VIEW_SHOPS = 'view shops';

    // Products Permissions
    const CREATE_PRODUCTS = 'create products';
    const UPDATE_PRODUCTS = 'update products';
    const DELETE_PRODUCTS = 'delete products';
    const VIEW_PRODUCTS = 'view products';

    // Sections Permissions
    const CREATE_SECTIONS = 'create sections';
    const UPDATE_SECTIONS = 'update sections';
    const DELETE_SECTIONS = 'delete sections';
    const VIEW_SECTIONS = 'view sections';

    // Taxes permissions
    const CREATE_TAXES = 'create taxes';
    const UPDATE_TAXES = 'update taxes';
    const DELETE_TAXES = 'delete taxes';
    const VIEW_TAXES = 'view taxes';

    // Discounts permissions
    const CREATE_DISCOUNTS = 'create discounts';
    const UPDATE_DISCOUNTS = 'update discounts';
    const DELETE_DISCOUNTS = 'delete discounts';
    const VIEW_DISCOUNTS = 'view discounts';

    // Cuisines permissions
    const CREATE_CUISINES = 'create cuisines';
    const UPDATE_CUISINES = 'update cuisines';
    const DELETE_CUISINES = 'delete cuisines';
    const VIEW_CUISINES = 'view cuisines';

    // Users permissions
    const CREATE_USERS = 'create users';
    const UPDATE_USERS = 'update users';
    const DELETE_USERS = 'delete users';
    const VIEW_USERS = 'view users';

    // Cities
    const CREATE_CITIES = 'create cities';
    const UPDATE_CITIES = 'update cities';
    const DELETE_CITIES = 'delete cities';
    const VIEW_CITIES = 'view cities';

    // Countries 
    const CREATE_COUNTRIES = 'create countries';
    const UPDATE_COUNTRIES = 'update countries';
    const DELETE_COUNTRIES = 'delete countries';
    const VIEW_COUNTRIES = 'view countries';

    // Regions
    const CREATE_REGIONS = 'create regions';
    const UPDATE_REGIONS = 'update regions';
    const DELETE_REGIONS = 'delete regions';
    const VIEW_REGIONS = 'view regions';

    // Orders 
    const CREATE_ORDERS = 'create orders';
    const UPDATE_ORDERS = 'update orders';
    const DELETE_ORDERS = 'delete orders';
    const VIEW_ORDERS = 'view orders';

    // Order Statuses 
    const CREATE_ORDER_STATUSES = 'create order statuses';
    const UPDATE_ORDER_STATUSES = 'update order statuses';
    const DELETE_ORDER_STATUSES = 'delete order statuses';
    const VIEW_ORDER_STATUSES = 'view order statuses';

    // Shop Account Statuses
    const CREATE_SHOP_ACCOUNT_STATUSES = 'create shop account statuses';
    const UPDATE_SHOP_ACCOUNT_STATUSES = 'update shop account statuses';
    const DELETE_SHOP_ACCOUNT_STATUSES = 'delete shop account statuses';
    const VIEW_SHOP_ACCOUNT_STATUSES = 'view shop account statuses';

    // User Account Statuses
    const CREATE_USER_ACCOUNT_STATUSES= 'create user account statuses';
    const UPDATE_USER_ACCOUNT_STATUSES= 'update user account statuses';
    const DELETE_USER_ACCOUNT_STATUSES= 'delete user account statuses';
    const VIEW_USER_ACCOUNT_STATUSES= 'view user account statuses';

    // Shop Types
    const CREATE_SHOP_TYPES = 'create shop types';
    const UPDATE_SHOP_TYPES = 'update shop types';
    const DELETE_SHOP_TYPES = 'delete shop types';
    const VIEW_SHOP_TYPES = 'view shop types';

    // Order Types
    const CREATE_ORDER_TYPES = 'create order types';
    const UPDATE_ORDER_TYPES = 'update order types';
    const DELETE_ORDER_TYPES = 'delete order types';
    const VIEW_ORDER_TYPES = 'view order types';

    // Payment Methods
    const CREATE_PAYMENT_METHODS = 'create payment methods';
    const UPDATE_PAYMENT_METHODS = 'update payment methods';
    const DELETE_PAYMENT_METHODS = 'delete payment methods';
    const VIEW_PAYMENT_METHODS = 'view payment methods';

}
