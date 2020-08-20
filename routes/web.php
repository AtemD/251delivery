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

// Company Admin Routes
Route::get('/dashboard/company/home', 'Company\CompanyController@index')
    ->name('company.home');

// Company Shops
Route::get('/dashboard/company/shops', 'Company\CompanyShopsController@index')
->name('company.shops.index');

// Company Users
Route::get('/dashboard/company/users', 'Company\CompanyUsersController@index')
->name('company.users.index');

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

// Company Payment Methods
Route::get('/dashboard/company/settings/payment-methods', 'Company\CompanyPaymentMethodsController@index')
->name('company.settings.payment-methods.index');

// Company Shop Types
Route::get('/dashboard/company/settings/shop-types', 'Company\CompanyShopTypesController@index')
->name('company.settings.shop-types.index');

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

// Company Shop Account Statuses
Route::get('/dashboard/company/settings/shop-account-statuses', 'Company\CompanyShopAccountStatusesController@index')
->name('company.settings.shop-account-statuses.index');

// Company User Account Statuses
Route::get('/dashboard/company/settings/user-account-statuses', 'Company\CompanyUserAccountStatusesController@index')
->name('company.settings.user-account-statuses.index');

// Countries
Route::get('/dashboard/company/settings/countries', 'Company\CompanyCountriesController@index')
->name('company.settings.countries.index');

// Regions
Route::get('/dashboard/company/settings/regions', 'Company\CompanyRegionsController@index')
->name('company.settings.regions.index');

// Cities
Route::get('/dashboard/company/settings/cities', 'Company\CompanyCitiesController@index')
->name('company.settings.cities.index');