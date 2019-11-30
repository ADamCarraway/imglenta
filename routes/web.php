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

Route::get('/', 'ShowUserFeedController@index');

Auth::routes();

Route::view('/home', 'home')->middleware('auth')->name('home'); //TODO make a test

Route::resource('feeds','FeedController')->middleware('auth');

Route::get('/feeds/{feed}/photos', 'PhotoController@create')->middleware('auth')->name('photos.create');
Route::post('/feeds/{feed}/photos', 'PhotoController@store')->middleware('auth')->name('photos.store');
Route::delete('/feeds/{feed}/photos/{photo}', 'PhotoController@destroy')->middleware('auth')->name('photos.destroy');

Route::post('/feeds/{feed}/photos/{photo}/like', 'LikeController@store')->middleware('auth')->name('photos.like');
Route::delete('/feeds/{feed}/photos/{photo}/unlike', 'LikeController@destroy')->middleware('auth')->name('photos.unlike');

Route::post('/feeds/{feed}/subscribe', 'SubscribeController@store')->middleware('auth')->name('feeds.subscribe');
Route::delete('/feeds/{feed}/unsubscribe', 'SubscribeController@destroy')->middleware('auth')->name('feeds.unsubscribe');

Route::get('user/feeds/{feed}', 'ShowUserFeedController@show')->name('user.feeds.show');

