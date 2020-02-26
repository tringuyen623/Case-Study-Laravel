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
Route::get('room-list', 'Frontend\HomeController@roomList')->name('room-list');
Route::get('room-details', 'Frontend\HomeController@roomDetails')->name('room-details');
Route::get('room-available', 'Frontend\HomeController@checkAvailable')->name('check-available');
// Route::get('room-details/{room}', 'Frontend\HomeController@book')->name('room-details-booking');
// Route::get('room-details/{room}/book', 'Frontend\HomeController@book')->name('book');
Route::get('payment', 'Frontend\HomeController@payment')->name('payment');
Route::post('booking', 'Frontend\HomeController@booking')->name('booking');
Route::get('checkout', 'Frontend\HomeController@checkout')->name('checkout');

Route::get('about', function () {
    return view('front_end.about');
})->name('about');

// Route::get('rooms', 'Frontend\RoomController@index')->name('rooms');
// Route::get('rooms/check-available', 'Frontend\RoomController@checkAvailable')->name('check');



// Route::get('bookings/check', 'BookingController@check')->name('check');
Route::get('bookings/search/{id}', 'BookingController@search');

Auth::routes();

Route::name('admin.')->prefix('admin')->group(function () {
    Route::get('/', function () {

        if (Auth::user()) {
            return redirect('admin/dashboard');
        }
        return view('auth.login');
    })->name('login');

    Route::get('dashboard', 'Backend\HomeController@index')->name('dashboard');

    Route::get('/hotel', 'Backend\HotelController@index')->name('hotel.index');
    Route::get('/hotel/{id}/edit', 'Backend\HotelController@edit')->name('hotel.edit');
    Route::patch('/hotel/{id}', 'Backend\HotelController@update')->name('hotel.update');

    Route::get('rooms/list', 'Backend\RoomController@getData')->name('rooms.list');
    Route::resource('rooms', 'Backend\RoomController');

    Route::get('room-types/list', 'Backend\RoomTypeController@getData')->name('room-types.list');
    Route::get('room-types/listDeleted', 'Backend\RoomTypeController@getDeletedData')->name('room-types.listDeleted');
    Route::get('room-types/{id}/restore', 'Backend\RoomTypeController@restore')->name('room-types.restore');
    Route::resource('room-types', 'Backend\RoomTypeController');
    Route::post('room-types/upload-image', 'Backend\RoomTypeController@uploadImage')->name('room-types.storeImage');

    Route::resource('amenities', 'Backend\AmenityController');

    Route::get('galleries/listDeleted', 'Backend\HotelGalleryController@getDeletedData')->name('galleries.listDeleted');
    Route::get('galleries/{id}/restore', 'Backend\HotelGalleryController@restore')->name('galleries.restore');
    Route::resource('galleries', 'Backend\HotelGalleryController');

    Route::get('taxes/listDeleted', 'Backend\TaxController@getDeletedData')->name('taxes.listDeleted');
    Route::get('taxes/{id}/restore', 'Backend\TaxController@restore')->name('taxes.restore');
    Route::resource('taxes', 'Backend\TaxController');

    Route::get('gallery-categories/listDeleted', 'Backend\GalleryCategoryController@getDeletedData')->name('gallery-categories.listDeleted');
    Route::get('gallery-categories/{id}/restore', 'Backend\GalleryCategoryController@restore')->name('gallery-categories.restore');
    Route::resource('gallery-categories', 'Backend\GalleryCategoryController');
    
    Route::get('bookings/listDeleted', 'Backend\BookingController@getDeletedData')->name('bookings.listDeleted');
    Route::resource('bookings', 'Backend\BookingController');
});

// // Route::get('/home', 'Backend\HomeController@index')->name('admin');



// // Route::resource('rooms', 'RoomController');
// // Route::resource('rooms/types', 'RoomTypeController');


Route::resource('bookings', 'BookingController');
