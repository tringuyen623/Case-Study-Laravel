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
    return view('front_end.home');
})->name('home');

Route::get('about', function(){
    return view('front_end.about');
})->name('about');

Route::get('rooms', function(){
    return view('front_end.rooms');
})->name('rooms');

Auth::routes();

Route::name('admmin.')->prefix('admin')->group(function() {
    Route::get('/home', 'Backend\HomeController@index')->name('admin');
});

// Route::get('/home', 'Backend\HomeController@index')->name('admin');

// Route::get('/hotels', 'Backend\HotelController@index')->name('hotels.index');
// Route::get('/hotels/{id}', 'HotelController@edit')->name('hotels.edit');
// Route::patch('/hotels/{id}', 'HotelController@update')->name('hotels.update');

// Route::resource('rooms', 'RoomController');
// Route::resource('rooms/types', 'RoomTypeController');

Route::get('bookings/check', 'BookingController@check')->name('check');
Route::get('bookings/search/{id}', 'BookingController@search');
Route::resource('bookings', 'BookingController');
