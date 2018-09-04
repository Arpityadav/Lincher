<?php


Route::get('/', 'PostsController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/{user}', 'UsersController@show');

Route::post('/{user}/sendFriendRequest', 'UsersController@sendFriendRequest');
Route::post('/{user}/cancelFriendRequest', 'UsersController@cancelFriendRequest');
Route::delete('/{user}/deleteFriend', 'UsersController@deleteFriend');
