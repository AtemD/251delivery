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
}
