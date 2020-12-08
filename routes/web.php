<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@welcome')->name('pages.welcome');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');



// Route::get('/shops/filter-results', 'ShopSearchController@filter')
// ->name('shops.filters');

// Shops Routes
Route::get('/shops', 'ShopsController@index')
    ->name('shops.index');
Route::get('/shops/{shop}', 'ShopsController@show')
    ->name('shops.show');

// Proceed to checkout route
Route::get('/checkout', 'CheckoutController@index')
->name('checkout.index');
Route::post('/checkout', 'CheckoutController@store')
->name('checkout.store');

// Place order route
Route::post('/place-order', 'PlaceOrderController@store')
->name('place_order.store');

// Thank you
Route::get('/thank-you', 'ThankYouController@index')
->name('thank-you.index');






// BUYER ROUTES

Route::get('dashboard/buyer/home', 'Buyer\HomeController@index')
->name('buyers.home');

//Account settings
Route::get('dashboard/buyer/settings/account', 'Buyer\AccountsController@index')
->name('buyers.accounts.index');
Route::get('dashboard/buyer/settings/account/edit', 'Buyer\AccountsController@edit')
->name('buyers.accounts.edit');
Route::put('dashboard/buyer/settings/account', 'Buyer\AccountsController@update')
->name('buyers.accounts.update');

// Buyer E-Wallet
Route::get('dashboard/buyer/e-wallet-account', 'Buyer\EWalletAccountsController@index')
->name('buyers.e-wallet-accounts.index');


// Buyer Orders
Route::get('dashboard/buyer/orders', 'Buyer\OrdersController@index')
->name('buyers.orders.index');

// COMPANY ADMIN ROUTES

Route::get('/dashboard/company/home', 'Company\HomeController@index')
    ->name('company.home');

// Company Shops
Route::get('/dashboard/company/shops', 'Company\ShopsController@index')
->name('company.shops.index');
Route::post('/dashboard/company/shops', 'Company\ShopsController@store')
->name('company.shops.store');
Route::get('/dashboard/company/shops/{shop}/edit', 'Company\ShopsController@edit')
->name('company.shops.edit');
Route::put('/dashboard/company/shops/{shop}', 'Company\ShopsController@update')
->name('company.shops.update');
Route::delete('/dashboard/company/shops/{shop}', 'Company\ShopsController@destroy')
->name('company.shops.destroy');

// Company Users
Route::get('/dashboard/company/users', 'Company\UsersController@index')
->name('company.users.index');
Route::post('/dashboard/company/users', 'Company\UsersController@store')
->name('company.users.store');
Route::get('/dashboard/company/users/{user}/edit', 'Company\UsersController@edit')
->name('company.users.edit');
Route::put('/dashboard/company/users/{user}', 'Company\UsersController@update')
->name('company.users.update');
Route::delete('/dashboard/company/users/{user}', 'Company\UsersController@destroy')
->name('company.users.destroy');


// Company user E-Wallet accounts
Route::get('dashboard/compapny/e-wallet-accounts', 'Company\EWalletAccountsController@index')
->name('company.e-wallet-accounts.index');
Route::post('/dashboard/company/e-wallet-accounts', 'Company\EWalletAccountsController@store')
->name('company.e-wallet-accounts.store');
Route::get('/dashboard/company/e-wallet-accounts/{e_wallet_account}/edit', 'Company\EWalletAccountsController@edit')
->name('company.e-wallet-accounts.edit');
Route::put('/dashboard/company/e-wallet-accounts/{e_wallet_account}', 'Company\EWalletAccountsController@update')
->name('company.e-wallet-accounts.update');
Route::delete('/dashboard/company/e-wallet-accounts/{e_wallet_account}', 'Company\EWalletAccountsController@destroy')
->name('company.e-wallet-accounts.destroy');

// Company user E-Wallet deposits
Route::put('/dashboard/company/e-wallet-accounts/{e_wallet_account}/deposits', 'Company\EWalletAccountDepositsController@update')
->name('company.e-wallet-accounts.deposits.update');
// Company user E-Wallet withdrawals
Route::put('/dashboard/company/e-wallet-accounts/{e_wallet_account}/withdrawals', 'Company\EWalletAccountWithdrawalsController@update')
->name('company.e-wallet-accounts.withdrawals.update');
// Company E-wallet account status
Route::put('/dashboard/company/e-wallet-accounts/{e_wallet_account}/status', 'Company\EWalletAccountStatusController@update')
->name('company.e-wallet-account-statuses.update');


// Company user account statuses
Route::put('/dashboard/company/users/{user}/account-status', 'Company\UserAccountStatusController@update')
->name('company.users.account-statuses.update');
// Company user roles
Route::put('/dashboard/company/users/{user}/roles', 'Company\UserRolesController@update')
->name('company.users.roles.update');

// Company Retailers
Route::get('/dashboard/company/retailers', 'Company\RetailersController@index')
->name('company.retailers.index');
Route::post('/dashboard/company/retailers', 'Company\RetailersController@store')
->name('company.retailers.store');
Route::put('/dashboard/company/retailers/{retailer}', 'Company\RetailersController@update')
->name('company.retailers.update');
Route::delete('/dashboard/company/retailers/{retailer}', 'Company\RetailersController@destroy')
->name('company.retailers.destroy');

// Company Buyers
Route::get('/dashboard/company/buyers', 'Company\BuyersController@index')
->name('company.buyers.index');
// Route::post('/dashboard/company/buyers', 'Company\BuyersController@store')
// ->name('company.buyers.store');
// Route::put('/dashboard/company/buyers/{buyer}', 'Company\BuyersController@update')
// ->name('company.buyers.update');
// Route::delete('/dashboard/company/buyers/{buyer}', 'Company\BuyersController@destroy')
// ->name('company.buyers.destroy');

// Company Orders
Route::get('/dashboard/company/orders', 'Company\OrdersController@index')
->name('company.orders.index');

// Company Order Types
Route::get('/dashboard/company/settings/order-types', 'Company\OrderTypesController@index')
->name('company.order-types.index');
Route::post('/dashboard/company/settings/order-types', 'Company\OrderTypesController@store')
->name('company.order-types.store');
Route::get('/dashboard/company/settings/order-types/{order_type}/edit', 'Company\OrderTypesController@edit')
->name('company.order-types.edit');
Route::put('/dashboard/company/settings/order-types/{order_type}', 'Company\OrderTypesController@update')
->name('company.order-types.update');
Route::delete('/dashboard/company/settings/order-types/{order_type}', 'Company\OrderTypesController@destroy')
->name('company.order-types.destroy');

// Company Payment Methods
Route::get('/dashboard/company/settings/payment-methods', 'Company\PaymentMethodsController@index')
->name('company.payment-methods.index');
Route::post('/dashboard/company/settings/payment-methods', 'Company\PaymentMethodsController@store')
->name('company.payment-methods.store');
Route::get('/dashboard/company/settings/payment-methods/{payment_method}/edit', 'Company\PaymentMethodsController@edit')
->name('company.payment-methods.edit');
Route::put('/dashboard/company/settings/payment-methods/{payment_method}', 'Company\PaymentMethodsController@update')
->name('company.payment-methods.update');
Route::delete('/dashboard/company/settings/payment-methods/{payment_method}', 'Company\PaymentMethodsController@destroy')
->name('company.payment-methods.destroy');

// Company Shop Types
Route::get('/dashboard/company/settings/shop-types', 'Company\ShopTypesController@index')
->name('company.shop-types.index');
Route::post('/dashboard/company/settings/shop-types', 'Company\ShopTypesController@store')
->name('company.shop-types.store');
Route::get('/dashboard/company/settings/shop-types/{shop_type}/edit', 'Company\ShopTypesController@edit')
->name('company.shop-types.edit');
Route::put('/dashboard/company/settings/shop-types/{shop_type}', 'Company\ShopTypesController@update')
->name('company.shop-types.update');
Route::delete('/dashboard/company/settings/shop-types/{shop_type}', 'Company\ShopTypesController@destroy')
->name('company.shop-types.destroy');

// Company Cuisines
Route::get('/dashboard/company/settings/cuisines', 'Company\CuisinesController@index')
->name('company.cuisines.index');
Route::post('/dashboard/company/settings/cuisines', 'Company\CuisinesController@store')
->name('company.cuisines.store');
Route::get('/dashboard/company/settings/cuisines/{cuisine}/edit', 'Company\CuisinesController@edit')
->name('company.cuisines.edit');
Route::put('/dashboard/company/settings/cuisines/{cuisine}', 'Company\CuisinesController@update')
->name('company.cuisines.update');
Route::delete('/dashboard/company/settings/cuisines/{cuisine}', 'Company\CuisinesController@destroy')
->name('company.cuisines.destroy');

// Company Order Statuses
Route::get('/dashboard/company/settings/statuses/order-statuses', 'Company\OrderStatusesController@index')
->name('company.order-statuses.index');
Route::post('/dashboard/company/settings/statuses/order-statuses', 'Company\OrderStatusesController@store')
->name('company.order-statuses.store');
Route::get('/dashboard/company/settings/statuses/order-statuses/{order_status}/edit', 'Company\OrderStatusesController@edit')
->name('company.order-statuses.edit');
Route::put('/dashboard/company/settings/statuses/order-statuses/{order_status}', 'Company\OrderStatusesController@update')
->name('company.order-statuses.update');
Route::delete('/dashboard/company/settings/statuses/order-statuses/{order_status}', 'Company\OrderStatusesController@destroy')
->name('company.order-statuses.destroy');

// Company Shop Account Statuses
Route::get('/dashboard/company/settings/statuses/shop-account-statuses', 'Company\ShopAccountStatusesController@index')
->name('company.shop-account-statuses.index');
Route::post('/dashboard/company/settings/statuses/shop-account-statuses', 'Company\ShopAccountStatusesController@store')
->name('company.shop-account-statuses.store');
Route::get('/dashboard/company/settings/statuses/shop-account-statuses/{shop_account_status}/edit', 'Company\ShopAccountStatusesController@edit')
->name('company.shop-account-statuses.edit');
Route::put('/dashboard/company/settings/statuses/shop-account-statuses/{shop_account_status}', 'Company\ShopAccountStatusesController@update')
->name('company.shop-account-statuses.update');
Route::delete('/dashboard/company/settings/statuses/shop-account-statuses/{shop_account_status}', 'Company\ShopAccountStatusesController@destroy')
->name('company.shop-account-statuses.destroy');

// Company User Account Statuses
Route::get('/dashboard/company/settings/statuses/user-account-statuses', 'Company\UserAccountStatusesController@index')
->name('company.user-account-statuses.index');
Route::post('/dashboard/company/settings/statuses/user-account-statuses', 'Company\UserAccountStatusesController@store')
->name('company.user-account-statuses.store');
Route::get('/dashboard/company/settings/statuses/user-account-statuses/{user_account_status}/edit', 'Company\UserAccountStatusesController@edit')
->name('company.user-account-statuses.edit');
Route::put('/dashboard/company/settings/statuses/user-account-statuses/{user_account_status}', 'Company\UserAccountStatusesController@update')
->name('company.user-account-statuses.update');
Route::delete('/dashboard/company/settings/statuses/user-account-statuses/{user_account_status}', 'Company\UserAccountStatusesController@destroy')
->name('company.user-account-statuses.destroy');

// Countries
Route::get('/dashboard/company/settings/locations/countries', 'Company\CountriesController@index')
->name('company.countries.index');
Route::post('/dashboard/company/settings/locations/countries', 'Company\CountriesController@store')
->name('company.countries.store');
Route::get('/dashboard/company/settings/locations/countries/{country}/edit', 'Company\CountriesController@edit')
->name('company.countries.edit');
Route::put('/dashboard/company/settings/locations/countries/{country}', 'Company\CountriesController@update')
->name('company.countries.update');
Route::delete('/dashboard/company/settings/locations/countries/{country}', 'Company\CountriesController@destroy')
->name('company.countries.destroy');

// Regions
Route::get('/dashboard/company/settings/locations/regions', 'Company\RegionsController@index')
->name('company.regions.index');
Route::post('/dashboard/company/settings/locations/regions', 'Company\RegionsController@store')
->name('company.regions.store');
Route::get('/dashboard/company/settings/locations/regions/{region}/edit', 'Company\RegionsController@edit')
->name('company.regions.edit');
Route::put('/dashboard/company/settings/locations/regions/{region}', 'Company\RegionsController@update')
->name('company.regions.update');
Route::delete('/dashboard/company/settings/locations/regions/{region}', 'Company\RegionsController@destroy')
->name('company.regions.destroy');

// Cities
Route::get('/dashboard/company/settings/locations/cities', 'Company\CitiesController@index')
->name('company.cities.index');
Route::post('/dashboard/company/settings/locations/cities', 'Company\CitiesController@store')
->name('company.cities.store');
Route::get('/dashboard/company/settings/locations/cities/{city}/edit', 'Company\CitiesController@edit')
->name('company.cities.edit');
Route::put('/dashboard/company/settings/locations/cities/{city}', 'Company\CitiesController@update')
->name('company.cities.update');
Route::delete('/dashboard/company/settings/locations/cities/{city}', 'Company\CitiesController@destroy')
->name('company.cities.destroy');

// Roles
Route::get('/dashboard/company/settings/access-control-levels/roles', 'Company\RolesController@index')
->name('company.roles.index');
Route::post('/dashboard/company/settings/access-control-levels/roles', 'Company\RolesController@store')
->name('company.roles.store');
Route::get('/dashboard/company/settings/access-control-levels/roles/{role}/edit', 'Company\RolesController@edit')
->name('company.roles.edit');
Route::put('/dashboard/company/settings/access-control-levels/roles/{role}', 'Company\RolesController@update')
->name('company.roles.update');
Route::delete('/dashboard/company/settings/access-control-levels/roles/{role}', 'Company\RolesController@destroy')
->name('company.roles.destroy');

// Role Permissions
Route::put('/dashboard/company/settings/access-control-levels/roles/{role}/permissions', 'Company\RolePermissionsController@update')
->name('company.role.permissions.update');

// Permissions
Route::get('/dashboard/company/settings/access-control-levels/permissions', 'Company\PermissionsController@index')
->name('company.permissions.index');
Route::post('/dashboard/company/settings/access-control-levels/permissions', 'Company\PermissionsController@store')
->name('company.permissions.store');
Route::get('/dashboard/company/settings/access-control-levels/permissions/{permission}/edit', 'Company\PermissionsController@edit')
->name('company.permissions.edit');
Route::put('/dashboard/company/settings/access-control-levels/permissions/{permission}', 'Company\PermissionsController@update')
->name('company.permissions.update');
Route::delete('/dashboard/company/settings/access-control-levels/permissions/{permission}', 'Company\PermissionsController@destroy')
->name('company.permissions.destroy');

// Permission Roles
Route::put('/dashboard/company/settings/access-control-levels/permissions/{permission}/roles', 'Company\PermissionRolesController@update')
->name('company.permission.roles.update');

// RETAILER ROUTES

Route::get('/dashboard/retailer/shops', 'Retailer\HomeController@index')
->name('retailer.shops');

// Route::get('/dashboard/retailer/{shop}/home', 'Retailer\HomeController@index')
// ->name('retailer.home');

// Retailer shops    
Route::get('/dashboard/retailer/shops/{shop}', 'Retailer\ShopsController@index')
->name('retailer.shops.index');
Route::post('/dashboard/retailer/shops', 'Retailer\ShopsController@store')
->name('retailer.shops.store');
Route::put('/dashboard/retailer/shops/{shop}', 'Retailer\ShopsController@update')
->name('retailer.shops.update');
Route::delete('/dashboard/retailer/shops/{shop}', 'Retailer\ShopsController@destroy')
->name('retailer.shops.destroy');  

// Retailer products
Route::get('/dashboard/retailer/shops/{shop}/products', 'Retailer\ShopProductsController@index')
->name('retailer.products.index');
Route::post('/dashboard/retailer/shops/{shop}/products', 'Retailer\ShopProductsController@store')
->name('retailer.products.store');
Route::get('/dashboard/retailer/shops/{shop}/products/{product}/edit', 'Retailer\ShopProductsController@edit')
->name('retailer.products.edit');
Route::put('/dashboard/retailer/shops/{shop}/products/{product}', 'Retailer\ShopProductsController@update')
->name('retailer.products.update');
Route::delete('/dashboard/retailer/shops/{shop}/products/{product}', 'Retailer\ShopProductsController@destroy')
->name('retailer.products.destroy');

// Retailer product availability
Route::put('/dashboard/retailer/shops/{shop}/products/{product}/availability', 'Retailer\ShopProductAvailabilityController@update')
->name('retailer.product.availability.update');


// Retailer product taxes
Route::put('/dashboard/retailer/shops/{shop}/products/{product}/taxes', 'Retailer\ShopProductTaxesController@update')
->name('retailer.product.taxes.update');

// Retailer product discounts
Route::put('/dashboard/retailer/shops/{shop}/products/{product}/discounts', 'Retailer\ShopProductDiscountsController@update')
->name('retailer.product.discounts.update');

// Retailer taxes
Route::get('/dashboard/retailer/shops/{shop}/settings/taxes', 'Retailer\ShopTaxesController@index')
->name('retailer.taxes.index');
Route::post('/dashboard/retailer/shops/{shop}/settings/taxes', 'Retailer\ShopTaxesController@store')
->name('retailer.taxes.store');
Route::get('/dashboard/retailer/shops/{shop}/settings/taxes/{tax}/edit', 'Retailer\ShopTaxesController@edit')
->name('retailer.taxes.edit');
Route::put('/dashboard/retailer/shops/{shop}/settings/taxes/{tax}', 'Retailer\ShopTaxesController@update')
->name('retailer.taxes.update');
Route::delete('/dashboard/retailer/shops/{shop}/settings/taxes/{tax}', 'Retailer\ShopTaxesController@destroy')
->name('retailer.taxes.destroy');

// Retailer discounts
Route::get('/dashboard/retailer/shops/{shop}/settings/discounts', 'Retailer\ShopDiscountsController@index')
->name('retailer.discounts.index');
Route::post('/dashboard/retailer/shops/{shop}/settings/discounts', 'Retailer\ShopDiscountsController@store')
->name('retailer.discounts.store');
Route::get('/dashboard/retailer/shops/{shop}/settings/discounts/{discount}/edit', 'Retailer\ShopDiscountsController@edit')
->name('retailer.discounts.edit');
Route::put('/dashboard/retailer/shops/{shop}/settings/discounts/{discount}', 'Retailer\ShopDiscountsController@update')
->name('retailer.discounts.update');
Route::delete('/dashboard/retailer/shops/{shop}/settings/discounts/{discount}', 'Retailer\ShopDiscountsController@destroy')
->name('retailer.discounts.destroy');

// Retailer shop product sections (The products of a shop)
Route::get('/dashboard/retailer/shops/{shop}/settings/sections', 'Retailer\ShopSectionsController@index')
->name('retailer.sections.index');
Route::post('/dashboard/retailer/shops/{shop}/settings/sections', 'Retailer\ShopSectionsController@store')
->name('retailer.sections.store');
Route::get('/dashboard/retailer/shops/{shop}/settings/sections/{section}/edit', 'Retailer\ShopSectionsController@edit')
->name('retailer.sections.edit');
Route::put('/dashboard/retailer/shops/{shop}/settings/sections/{section}', 'Retailer\ShopSectionsController@update')
->name('retailer.sections.update');
Route::delete('/dashboard/retailer/shops/{shop}/settings/sections/{section}', 'Retailer\ShopSectionsController@destroy')
->name('retailer.sections.destroy');

// Retailer shop section products (The products of a section)
Route::put('/dashboard/retailer/shops/{shop}/settings/sections/{section}/products', 'Retailer\ShopSectionProductsController@update')
->name('retailer.section.products.update');


// Retailer Shop Cuisines
Route::get('/dashboard/retailer/shops/{shop}/settings/cuisines', 'Retailer\ShopCuisinesController@index')
->name('retailer.cuisines.index');
// Route::post('/dashboard/retailer/shops/{shop}/settings/cuisines', 'Retailer\ShopCuisinesController@store')
// ->name('retailer.cuisines.store');
Route::get('/dashboard/retailer/shops/{shop}/settings/cuisines/edit', 'Retailer\ShopCuisinesController@edit')
->name('retailer.cuisines.edit');
Route::put('/dashboard/retailer/shops/{shop}/settings/cuisines', 'Retailer\ShopCuisinesController@update')
->name('retailer.cuisines.update');
// Route::delete('/dashboard/retailer/shops/{shop}/settings/cuisines', 'Retailer\ShopCuisinesController@destroy')
// ->name('retailer.cuisines.destroy');

// Retailer Shop Locations
Route::get('/dashboard/retailer/shops/{shop}/settings/locations', 'Retailer\ShopLocationsController@index')
->name('retailer.locations.index');
Route::post('/dashboard/retailer/shops/{shop}/settings/locations', 'Retailer\ShopLocationsController@store')
->name('retailer.locations.store');
Route::get('/dashboard/retailer/shops/{shop}/settings/locations/edit', 'Retailer\ShopLocationsController@edit')
->name('retailer.locations.edit');
Route::put('/dashboard/retailer/shops/{shop}/settings/locations', 'Retailer\ShopLocationsController@update')
->name('retailer.locations.update');
// Route::delete('/dashboard/retailer/shops/{shop}/settings/locations', 'Retailer\ShopLocationsController@destroy')
// ->name('retailer.locations.destroy');

// Retailer Shop Orders
Route::get('/dashboard/retailer/shops/{shop}/orders/history', 'Retailer\ShopOrdersController@index')
->name('retailer.orders.index');
Route::put('/dashboard/retailer/shops/{shop}/orders/{order}', 'Retailer\ShopOrdersController@update')
->name('retailer.orders.update');

// Retailer shop order management
// Route::get('/dashboard/retailer/shops/{shop}/orders/manage', 'Retailer\ShopOrdersManagementController@index')
// ->name('retailer.orders.index');


Route::get('/dashboard/retailer/shops/{shop}/orders/new', 'Retailer\ShopOrdersNewController@index')
->name('retailer.orders.new.index');
Route::get('/dashboard/retailer/shops/{shop}/orders/in-progress', 'Retailer\ShopOrdersInProgressController@index')
->name('retailer.orders.in-progress.index');
Route::get('/dashboard/retailer/shops/{shop}/orders/ready', 'Retailer\ShopOrdersReadyController@index')
->name('retailer.orders.ready.index');

// Retailer Shop Accounts
Route::get('/dashboard/retailer/shops/{shop}/settings/accounts', 'Retailer\ShopAccountsController@index')
->name('retailer.shops.accounts.index');
Route::get('/dashboard/retailer/shops/{shop}/settings/accounts/edit', 'Retailer\ShopAccountsController@edit')
->name('retailer.shops.accounts.edit');
Route::put('/dashboard/retailer/shops/{shop}/settings/accounts', 'Retailer\ShopAccountsController@update')
->name('retailer.shops.accounts.update');

// Retailer Shop Availability
Route::put('/dashboard/retailer/shops/{shop}/settings/availability', 'Retailer\ShopAvailabilityStatusController@update')
->name('retailer.shops.availability.update');

// Retailer Shop Banner Image Controller
Route::put('/dashboard/retailer/shops/{shop}/settings/image', 'Retailer\ShopImagesController@update')
->name('retailer.shops.images.update');

// Retailer Shop Users
Route::get('/dashboard/retailer/shops/{shop}/users', 'Retailer\ShopUsersController@index')
->name('retailer.users.index');
Route::post('/dashboard/retailer/shops/{shop}/users', 'Retailer\ShopUsersController@store')
->name('retailer.users.store');
Route::get('/dashboard/retailer/shops/{shop}/users/{user}/edit', 'Retailer\ShopUsersController@edit')
->name('retailer.users.edit');
Route::put('/dashboard/retailer/shops/{shop}/users/{user}', 'Retailer\ShopUsersController@update')
->name('retailer.users.update');
Route::delete('/dashboard/retailer/shops/{shop}/users/{user}', 'Retailer\ShopUsersController@destroy')
->name('retailer.users.destroy');

// Retailer User permissions
Route::put('/dashboard/retailer/shops/{shop}/users/{user}/permissions', 'Retailer\ShopUserPermissionsController@update')
->name('retailer.shops.users.permissions.update');
