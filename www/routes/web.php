<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/store_companies', 'HomeController@store_companies')->name('store_companies');
Route::get('read/{id?}', 'HomeController@read')->name('read');
Route::get('delete/{id?}', 'HomeController@delete')->name('delete');
Route::get('deleteAddress/{id?}', 'HomeController@delete_Address')->name('deleteAddress');
Route::get('read_address/{id?}', 'HomeController@read_address')->name('read_address');
Route::post('/store_address', 'HomeController@store_address')->name('store_address');