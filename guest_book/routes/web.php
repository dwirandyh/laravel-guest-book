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


Auth::routes();


Route::get('/guest', 'GuestController@index');
Route::post('/guest/save', 'GuestController@saveData');
Route::get('/company', 'CompanyController@index');
Route::post('/company/save', 'CompanyController@saveData');
Route::get('/', 'Administrator\DashboardController@index')->name('home');

Route::get('/administrator/guest', 'Administrator\GuestController@index');
Route::get('/administrator/guest/delete/{id}', 'Administrator\GuestController@delete');
Route::get('/administrator/guest/checkout/{id}', 'Administrator\GuestController@checkout');
Route::get('/administrator/guest/report', 'Administrator\GuestController@report');
Route::get('/administrator/guest/export', 'Administrator\GuestController@export');
Route::post('/administrator/guest/import', 'Administrator\GuestController@import');

Route::get('/administrator/company', 'Administrator\CompanyController@index');
Route::get('/administrator/company/delete/{id}', 'Administrator\CompanyController@delete');
Route::get('/administrator/company/checkout/{id}', 'Administrator\CompanyController@checkout');
Route::get('/administrator/company/report', 'Administrator\CompanyController@report');
Route::get('/administrator/company/export', 'Administrator\CompanyController@export');
Route::post('/administrator/company/import', 'Administrator\CompanyController@import');
