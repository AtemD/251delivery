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

Route::get('/home', 'HomeController@index')->name('home');

// Shops Routes
Route::get('/shops', 'ShopsController@index')
    ->name('shops.index');
Route::get('/shops/{shop}', 'ShopsController@show')
    ->name('shops.show');

// BUYER ROUTES

Route::get('dashboard/buyers/home', 'Buyer\BuyersController@index')
->name('buyers.home');

//Account settings
Route::get('dashboard/buyers/settings/account', 'Buyer\BuyerAccountsController@index')
->name('buyers.settings.accounts.index');
Route::put('dashboard/buyers/settings/account/{buyer}', 'Buyer\BuyerAccountsController@update')
->name('buyers.settings.accounts.update');

// Buyer Orders
Route::get('dashboard/buyers/orders/{buyer}', 'Buyer\BuyerOrdersController@index')
->name('buyers.orders.index');

// COMPANY ADMIN ROUTES

Route::get('/dashboard/company/home', 'Company\CompanyController@index')
    ->name('company.home');

// Company Shops
Route::get('/dashboard/company/shops', 'Company\CompanyShopsController@index')
->name('company.shops.index');

// Company Users
Route::get('/dashboard/company/users', 'Company\CompanyUsersController@index')
->name('company.users.index');
Route::post('/dashboard/company/users', 'Company\CompanyUsersController@store')
->name('company.users.store');
Route::put('/dashboard/company/users/{user}', 'Company\CompanyUsersController@update')
->name('company.users.update');
Route::delete('/dashboard/company/users/{user}', 'Company\CompanyUsersController@destroy')
->name('company.users.destroy');

// Company Orders
Route::get('/dashboard/company/orders', 'Company\CompanyOrdersController@index')
->name('company.orders.index');

// Company Order Types
Route::get('/dashboard/company/settings/order-types', 'Company\CompanyOrderTypesController@index')
->name('company.settings.order-types.index');
Route::post('/dashboard/company/settings/order-types', 'Company\CompanyOrderTypesController@store')
->name('company.settings.order-types.store');
Route::put('/dashboard/company/settings/order-types/{order_type}', 'Company\CompanyOrderTypesController@update')
->name('company.settings.order-types.update');
Route::delete('/dashboard/company/settings/order-types/{order_type}', 'Company\CompanyOrderTypesController@destroy')
->name('company.settings.order-types.destroy');

// Company Payment Methods
Route::get('/dashboard/company/settings/payment-methods', 'Company\CompanyPaymentMethodsController@index')
->name('company.settings.payment-methods.index');
Route::post('/dashboard/company/settings/payment-methods', 'Company\CompanyPaymentMethodsController@store')
->name('company.settings.payment-methods.store');
Route::put('/dashboard/company/settings/payment-methods/{payment_method}', 'Company\CompanyPaymentMethodsController@update')
->name('company.settings.payment-methods.update');
Route::delete('/dashboard/company/settings/payment-methods/{payment_method}', 'Company\CompanyPaymentMethodsController@destroy')
->name('company.settings.payment-methods.destroy');

// Company Shop Types
Route::get('/dashboard/company/settings/shop-types', 'Company\CompanyShopTypesController@index')
->name('company.settings.shop-types.index');
Route::post('/dashboard/company/settings/shop-types', 'Company\CompanyShopTypesController@store')
->name('company.settings.shop-types.store');
Route::put('/dashboard/company/settings/shop-types/{shop_type}', 'Company\CompanyShopTypesController@update')
->name('company.settings.shop-types.update');
Route::delete('/dashboard/company/settings/shop-types/{shop_type}', 'Company\CompanyShopTypesController@destroy')
->name('company.settings.shop-types.destroy');

// Company Cuisines
Route::get('/dashboard/company/settings/cuisines', 'Company\CompanyCuisinesController@index')
->name('company.settings.cuisines.index');
Route::post('/dashboard/company/settings/cuisines', 'Company\CompanyCuisinesController@store')
->name('company.settings.cuisines.store');
Route::put('/dashboard/company/settings/cuisines/{cuisine}', 'Company\CompanyCuisinesController@update')
->name('company.settings.cuisines.update');
Route::delete('/dashboard/company/settings/cuisines/{cuisine}', 'Company\CompanyCuisinesController@destroy')
->name('company.settings.cuisines.destroy');

// Company Order Statuses
Route::get('/dashboard/company/settings/order-statuses', 'Company\CompanyOrderStatusesController@index')
->name('company.settings.order-statuses.index');
Route::post('/dashboard/company/settings/order-statuses', 'Company\CompanyOrderStatusesController@store')
->name('company.settings.order-statuses.store');
Route::put('/dashboard/company/settings/order-statuses/{order_status}', 'Company\CompanyOrderStatusesController@update')
->name('company.settings.order-statuses.update');
Route::delete('/dashboard/company/settings/order-statuses/{order_status}', 'Company\CompanyOrderStatusesController@destroy')
->name('company.settings.order-statuses.destroy');

// Company Shop Account Statuses
Route::get('/dashboard/company/settings/shop-account-statuses', 'Company\CompanyShopAccountStatusesController@index')
->name('company.settings.shop-account-statuses.index');
Route::post('/dashboard/company/settings/shop-account-statuses', 'Company\CompanyShopAccountStatusesController@store')
->name('company.settings.shop-account-statuses.store');
Route::put('/dashboard/company/settings/shop-account-statuses/{shop_account_status}', 'Company\CompanyShopAccountStatusesController@update')
->name('company.settings.shop-account-statuses.update');
Route::delete('/dashboard/company/settings/shop-account-statuses/{shop_account_status}', 'Company\CompanyShopAccountStatusesController@destroy')
->name('company.settings.shop-account-statuses.destroy');

// Company User Account Statuses
Route::get('/dashboard/company/settings/user-account-statuses', 'Company\CompanyUserAccountStatusesController@index')
->name('company.settings.user-account-statuses.index');
Route::post('/dashboard/company/settings/user-account-statuses', 'Company\CompanyUserAccountStatusesController@store')
->name('company.settings.user-account-statuses.store');
Route::put('/dashboard/company/settings/user-account-statuses/{user_account_status}', 'Company\CompanyUserAccountStatusesController@update')
->name('company.settings.user-account-statuses.update');
Route::delete('/dashboard/company/settings/user-account-statuses/{user_account_status}', 'Company\CompanyUserAccountStatusesController@destroy')
->name('company.settings.user-account-statuses.destroy');

// Countries
Route::get('/dashboard/company/settings/countries', 'Company\CompanyCountriesController@index')
->name('company.settings.countries.index');
Route::post('/dashboard/company/settings/countries', 'Company\CompanyCountriesController@store')
->name('company.settings.countries.store');
Route::put('/dashboard/company/settings/countries/{country}', 'Company\CompanyCountriesController@update')
->name('company.settings.countries.update');
Route::delete('/dashboard/company/settings/countries/{country}', 'Company\CompanyCountriesController@destroy')
->name('company.settings.countries.destroy');

// Regions
Route::get('/dashboard/company/settings/regions', 'Company\CompanyRegionsController@index')
->name('company.settings.regions.index');
Route::post('/dashboard/company/settings/regions', 'Company\CompanyRegionsController@store')
->name('company.settings.regions.store');
Route::put('/dashboard/company/settings/regions/{region}', 'Company\CompanyRegionsController@update')
->name('company.settings.regions.update');
Route::delete('/dashboard/company/settings/regions/{region}', 'Company\CompanyRegionsController@destroy')
->name('company.settings.regions.destroy');

// Cities
Route::get('/dashboard/company/settings/cities', 'Company\CompanyCitiesController@index')
->name('company.settings.cities.index');
Route::post('/dashboard/company/settings/cities', 'Company\CompanyCitiesController@store')
->name('company.settings.cities.store');
Route::put('/dashboard/company/settings/cities/{city}', 'Company\CompanyCitiesController@update')
->name('company.settings.cities.update');
Route::delete('/dashboard/company/settings/cities/{city}', 'Company\CompanyCitiesController@destroy')
->name('company.settings.cities.destroy');