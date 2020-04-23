<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'IndexController@showIndex');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/profile', 'UserController@index')->name('profile')->middleware('auth'); // name nom de la view 
Route::get('/user/edit', 'UserController@edit')->name('edit')->middleware('auth');
Route::get('/user/update', 'UserController@update')->name('update')->middleware('auth');
Route::get('/user/delete', 'UserController@destroy')->name('delete')->middleware('auth');

Route::get('/annonces', 'AdController@index')->name('annonces')->middleware('auth');
Route::get('/user/annonces', 'AdController@show')->name('yourannonces')->middleware('auth');
Route::get('/user/deleteannonces', 'AdController@destroy')->name('deleteannonces')->middleware('auth');

Route::get('/user/editannonces', 'AdController@edit')->name('editannonces')->middleware('auth');
Route::post('/user/updateannonces', 'AdController@update')->name('updateannonces')->middleware('auth');

Route::get('/user/createannonces', 'AdController@create')->name('createannonces')->middleware('auth');
Route::post('/user/newannonces', 'AdController@store')->name('newannonces')->middleware('auth');

Route::get('/user/showannonces', 'AdController@showcontact')->name('showcontact')->middleware('auth');

Route::get('/search', 'AdController@search')->name('search')->middleware('auth');

Route::get('/message', 'MessageController@create')->name('message')->middleware('auth');
Route::get('/messagehome', 'MessageController@home')->name('messagehome')->middleware('auth');
Route::post('/sendmessage', 'MessageController@send')->name('sendmessage')->middleware('auth');
Route::post('/sendmessagehome', 'MessageController@sendhome')->name('sendmessagehome')->middleware('auth');


Auth::routes();
Route::resource('users', 'UserController');
