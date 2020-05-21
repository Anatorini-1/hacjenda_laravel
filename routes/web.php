<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'StartController@index');


//Offers
    
    Route::get('/offers', 'OfferController@index');
    Route::get('/offers/create', 'OfferController@create')->middleware('auth');
    Route::get('/offers/update/{id}','OfferController@update')->middleware('auth');
    Route::get('/offers/show/{id}', 'OfferController@show');
    Route::get('/offers/search/{id}','OfferController@search'); 
    Route::get('/offers/{id}','OfferController@index');
    Route::get('/offers/accept/{id}','OfferController@accept')->middleware('auth');
    
    Route::post('offers/update/{id}','OfferController@save_update')->middleware('auth');
    Route::post('offers/update/{id}','OfferController@save_update')->middleware('auth'); 
    Route::post('/offers', 'OfferController@store');
    Route::post('/offers/sample', 'OfferController@sample')->middleware('auth');

    Route::delete('/offers/wipe', 'OfferController@wipe');
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

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Auth::routes([
        //'register' => false
    ]);

    Route::get('/home', 'HomeController@index')->name('home');




















