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

Route::get('/', function () {
    return view('front_end.home');
})->name('home');

Route::get('about', function () {
    return view('front_end.about');
})->name('about');

Route::get('rooms', function () {
    return view('front_end.rooms');
})->name('rooms');

Route::get('bookings/check', 'BookingController@check')->name('check');
Route::get('bookings/search/{id}', 'BookingController@search');

Auth::routes();

Route::name('admmin.')->prefix('admin')->group(function () {
    Route::get('/', function () {
        if (Auth::user()){
            return redirect('admin/dashboard');
        }
        return view('auth.login');
    })->name('admin.login');
    Route::get('dashboard', 'Backend\HomeController@index')->name('admin.dashboard');
});

// Route::get('/home', 'Backend\HomeController@index')->name('admin');

// Route::get('/hotels', 'Backend\HotelController@index')->name('hotels.index');
// Route::get('/hotels/{id}', 'HotelController@edit')->name('hotels.edit');
// Route::patch('/hotels/{id}', 'HotelController@update')->name('hotels.update');

// Route::resource('rooms', 'RoomController');
// Route::resource('rooms/types', 'RoomTypeController');


Route::resource('bookings', 'BookingController');
