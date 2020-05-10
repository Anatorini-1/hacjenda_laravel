<?php

use Illuminate\Support\Facades\Route;



//GET REQUESTS

Route::get('/', 'StartController@index');

Route::get('/users/login', 'ProfileController@login');

Route::get('/users/myProfile', 'ProfileController@myProfile')->middleware('auth');

Route::get('/users/recovery', 'ProfileController@recovery');

Route::get('/offers', 'OfferController@index');

Route::get('/offers/create', 'OfferController@create');

Route::get('/offers/{id}', 'OfferController@show');

Route::get('/dev/adminPanel', 'DevController@adminPanel');

Route::get('/dev/test', 'DevController@test');


//POST REQUESTS

Route::post('/offers', 'OfferController@store');
Route::post('/offers/sample', 'OfferController@sample')->middleware('auth');


//DELETE REQUESTS

Route::delete('offers/{id}','OfferController@destroy')->middleware('auth');


Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes([
    //'register' => false
]);

Route::get('/home', 'HomeController@index')->name('home');
