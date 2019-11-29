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

Route::view('/home', 'home')->middleware('auth')->name('home'); //TODO make a test

Route::resource('feeds','FeedController')->middleware('auth');

Route::get('/feeds/{feed}/photos', 'PhotoController@create')->middleware('auth')->name('photos.create');
Route::post('/feeds/{feed}/photos', 'PhotoController@store')->middleware('auth')->name('photos.store');
Route::delete('/feeds/{feed}/photos/{photo}', 'PhotoController@destroy')->middleware('auth')->name('photos.destroy');
Route::post('/feeds/{feed}/photos/{photo}/like', 'LikeController@store')->middleware('auth')->name('photos.like');
Route::post('/feeds/{feed}/photos/{photo}/unlike', 'LikeController@destroy')->middleware('auth')->name('photos.unlike');
