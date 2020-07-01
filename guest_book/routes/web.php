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

Route::get('/', 'GuestController@index');
Route::post('/save', 'GuestController@saveData');
Route::get('/company', 'CompanyController@index');
Route::post('/company/save', 'CompanyController@saveData');
Route::get('/home', 'Administrator\GuestController@index')->name('home');
Route::get('/guest/delete/{id}', 'Administrator\GuestController@delete')->name('home');
