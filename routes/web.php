<?php

Route::get('/', 'ShowUserFeedController@index')->name('user.feeds.index');

Auth::routes();

Route::resource('feeds','FeedController')->middleware('auth');

Route::get('/feeds/{feed}/photos', 'PhotoController@create')->middleware('auth')->name('photos.create');
Route::post('/feeds/{feed}/photos', 'PhotoController@store')->middleware('auth')->name('photos.store');
Route::delete('/feeds/{feed}/photos/{photo}', 'PhotoController@destroy')->middleware('auth')->name('photos.destroy');

Route::post('/feeds/{feed}/photos/{photo}/like', 'LikeController@store')->middleware('auth')->name('photos.like');
Route::delete('/feeds/{feed}/photos/{photo}/unlike', 'LikeController@destroy')->middleware('auth')->name('photos.unlike');

Route::post('/feeds/{feed}/subscribe', 'SubscribeController@store')->middleware('auth')->name('feeds.subscribe');
Route::delete('/feeds/{feed}/unsubscribe', 'SubscribeController@destroy')->middleware('auth')->name('feeds.unsubscribe');

Route::get('user/feeds/{feed}', 'ShowUserFeedController@show')->name('user.feeds.show');

