<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'StartController@index');


//Offers

Route::get('/offers', 'OfferController@index');
Route::get('/offers/create', 'OfferController@create')->middleware('auth');
Route::get('/offers/update/{id}','OfferController@update')->middleware('auth');
Route::get('/offers/show/{id}', 'OfferController@show');
Route::get('/offers/search/{id}','OfferController@search'); 
Route::get('/offers/finished','OfferController@finished');
Route::get('/offers/finished/{id}','OfferController@finished');
Route::get('/offers/{id}','OfferController@index');
Route::get('/offers/review/{id}','OfferController@review')->middleware('auth');


Route::post('/offers/pending/{id}','OfferController@pending_accept')->middleware('auth');
Route::post('offers/update/{id}','OfferController@save_update')->middleware('auth'); 
Route::post('/offers', 'OfferController@store')->middleware('auth');
Route::post('/offers/sample', 'OfferController@sample')->middleware('auth');
Route::post('/offers/accept/{offer_id}&{user_id}','OfferController@accept')->middleware('auth');
Route::post('/offers/finish/{offer_id}','OfferController@finish')->middleware('auth');
Route::post('/offers/review/{id}','OfferController@store_review')->middleware('auth');
Route::post('/offers/finish_standing/{id}','OfferController@finish_standing')->middleware('auth');


Route::delete('/offers/wipe', 'OfferController@wipe')->middleware('auth');;
Route::delete('offers/{id}','OfferController@destroy')->middleware('auth');


//Dev
Route::get('/dev/adminPanel', 'DevController@adminPanel')->middleware('auth');

Route::get('/dev/test', 'DevController@test')->middleware('auth');

Route::post('/dev/sample','DevController@sample')->middleware('auth');

Route::delete('dev/wipeOffers','DevController@wipeOffers')->middleware('auth');

Route::delete('dev/wipeUsers','DevController@wipeUsers')->middleware('auth');

Route::post('dev/history','DevController@history')->middleware('auth');

//Auth

Route::get('/users/myProfile', 'ProfileController@myProfile')->middleware('auth');
Route::get('users/update', 'ProfileController@update')->middleware('auth');
Route::get('/users', 'ProfileController@index');
Route::post('users/update','ProfileController@save_update')->middleware('auth');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Auth::routes([
    //'register' => false
    ]);


    Route::get('/home', 'HomeController@index')->name('home');

//Users
        Route::get('/users/show/{id}','ProfileController@show');


















