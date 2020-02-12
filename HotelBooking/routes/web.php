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
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'Frontend\HomeController@index')->name('home');

Route::get('about', function () {
    return view('front_end.about');
})->name('about');

Route::get('rooms', 'Frontend\RoomController@index')->name('rooms');



Route::get('bookings/check', 'BookingController@check')->name('check');
Route::get('bookings/search/{id}', 'BookingController@search');

Auth::routes();

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/', function () {

        if (Auth::user()){
            return redirect('admin/dashboard');
        }
        return view('auth.login');
    })->name('login');

    Route::get('dashboard', 'Backend\HomeController@index')->name('dashboard');

    Route::resource('rooms', 'Backend\RoomController');

    Route::get('room-types/list', 'Backend\RoomTypeController@getData')->name('room-types.list');
    Route::resource('room-types', 'Backend\RoomTypeController');

});

// // Route::get('/home', 'Backend\HomeController@index')->name('admin');

// // Route::get('/hotels', 'Backend\HotelController@index')->name('hotels.index');
// // Route::get('/hotels/{id}', 'HotelController@edit')->name('hotels.edit');
// // Route::patch('/hotels/{id}', 'HotelController@update')->name('hotels.update');

// // Route::resource('rooms', 'RoomController');
// // Route::resource('rooms/types', 'RoomTypeController');


Route::resource('bookings', 'BookingController');
