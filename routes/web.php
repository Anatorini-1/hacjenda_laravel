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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index');

Route::get('/login', 'ProfileController@login');

Route::get('/myProfile', 'ProfileController@myProfile');

Route::get('/adminPanel', 'DevController@adminPanel');

Route::get('/postOffer', 'OfferController@postOffer');

Route::get('/recovery', 'ProfileController@recovery');

Route::get('/test', 'DevController@test');