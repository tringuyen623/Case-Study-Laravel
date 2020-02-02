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

Route::get('/hotels', 'HotelController@index')->name('hotels.index');
Route::get('/hotels/{id}', 'HotelController@edit')->name('hotels.edit');
Route::patch('/hotels/{id}', 'HotelController@update')->name('hotels.update');

Route::resource('rooms', 'RoomController');