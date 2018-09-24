<?php


Route::get('/', 'PostsController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/friends', 'UsersController@friendsIndex');

Route::get('/{user}', 'UsersController@show');

Route::post('/post', 'PostsController@store');
Route::get('/post/{post}', 'PostsController@show');

Route::post('/post/{post}/comment', 'CommentsController@create');

Route::post('/{user}/sendFriendRequest', 'UsersController@sendFriendRequest');
Route::post('/{user}/acceptFriendRequest', 'UsersController@acceptFriendRequest');
Route::post('/{user}/updateDP', 'UsersController@updateDP');
Route::post('/{user}/cancelFriendRequest', 'UsersController@cancelFriendRequest');
Route::post('/{user}/deleteFriend', 'UsersController@deleteFriend');
