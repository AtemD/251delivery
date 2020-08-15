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

Route::get('/dashboard/company/shops', 'Company\CompanyShopsController@index')
->name('company.shops.index');
