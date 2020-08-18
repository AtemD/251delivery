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

// Company Payment Methods
Route::get('/dashboard/company/settings/payment-methods', 'Company\CompanyPaymentMethodsController@index')
->name('company.settings.payment-methods.index');

// Company Shop Types
Route::get('/dashboard/company/settings/shop-types', 'Company\CompanyShopTypesController@index')
->name('company.settings.shop-types.index');
