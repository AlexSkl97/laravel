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

Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/services','PagesController@services');

Route::resource('posts', 'PostController');
Auth::routes();

Route::get('/home', 'DashboardController@index')->name('home');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index');

Route::get('/search', 'PostController@search')->name('search');

Route::resource('users', 'UserController');

Route::get('/profile', 'PagesController@profile');

Route::get('/userProfile', 'PostController@userProfile')->name('userProfile');

Route::resource('challenges', 'ChallengeController');

Route::post('/addLikes', 'PostController@addLikes')->name('addLikes');

Route::post('/challenge_input', 'ChallengeController@correctKey')->name('challenge_input');
