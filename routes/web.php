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
Route::get('/feeds/create', 'FeedController@create')->name('feeds.create');
Route::post('/feeds', 'FeedController@store')->name('feeds.store');
Route::post('/feeds/{feed}/destroy', 'FeedController@destroy')->name('feeds.destroy');

Route::view('/items/create','feeds.items.create')->middleware('auth')->name('items.create');
