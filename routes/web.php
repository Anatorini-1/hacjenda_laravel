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


//GET REQUESTS

Route::get('/', 'StartController@index');

Route::get('/users/login', 'ProfileController@login');

Route::get('/users/myProfile', 'ProfileController@myProfile');

Route::get('/users/recovery', 'ProfileController@recovery');

Route::get('/offers', 'OfferController@index');

Route::get('/offers/create', 'OfferController@create');

Route::get('/offers/{id}', 'OfferController@show');

Route::get('/dev/adminPanel', 'DevController@adminPanel');

Route::get('/dev/test', 'DevController@test');


//POST REQUESTS

Route::post('/offers', 'OfferController@store');


//DELETE REQUESTS

Route::delete('offers/{id}','OfferController@destroy');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
