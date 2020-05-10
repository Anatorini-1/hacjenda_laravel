<?php

use Illuminate\Support\Facades\Route;

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



Route::get('/', 'HomeController@index');

Route::get('/users/login', 'ProfileController@login');

Route::get('/users/myProfile', 'ProfileController@myProfile');

Route::get('/users/recovery', 'ProfileController@recovery');

Route::get('/offers', 'OfferController@index');

Route::get('/offers/create', 'OfferController@create');

Route::get('/offers/{id}', 'OfferController@show');

Route::get('/dev/adminPanel', 'DevController@adminPanel');

Route::get('/dev/test', 'DevController@test');

Route::post('/offers', 'OfferController@store');
