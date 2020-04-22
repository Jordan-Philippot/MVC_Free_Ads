<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'IndexController@showIndex');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user/profile', 'UserController@index')->name('profile'); // name nom de la view 
Route::get('/user/edit', 'UserController@edit')->name('edit');
Route::get('/user/update', 'UserController@update')->name('update');
Route::get('/user/delete', 'UserController@destroy')->name('delete');

Route::get('/annonces', 'AdController@index')->name('annonces');
Route::get('/user/annonces', 'AdController@show')->name('yourannonces');
Route::get('/user/deleteannonces', 'AdController@destroy')->name('deleteannonces');

Route::get('/user/editannonces', 'AdController@edit')->name('editannonces');
Route::post('/user/updateannonces', 'AdController@update')->name('updateannonces');

Route::get('/user/createannonces', 'AdController@create')->name('createannonces');
Route::post('/user/newannonces', 'AdController@store')->name('newannonces');

Route::get('/user/showannonces', 'AdController@showcontact')->name('showcontact');

Route::get('/search', 'AdController@search')->name('search');


Auth::routes();
Route::resource('users', 'UserController');
