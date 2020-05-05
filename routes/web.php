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


Route::get('/home', function () {

    //przykładowe dane, w założeniu pobrane z bazy
    
    $data = [
        'numer' => 0,
        'author' => "Anatorini",
        'desc' => "Some random string idk",
    ];

    return view('home', $data);
    //Strona główna, htaccess przekierowuje domyślnie na ten widok

});

Route::get('/login', function () {
    return view('login');
    //panel logowania/rejestracji
});

Route::get('/myProfile', function () {
    return view('myProfile');
    //widok profilu urzytkownika
});

Route::get('/adminPanel', function () {
    return view('adminPanel');
    //widok panelu administratora
});

Route::get('/postOffer', function () {
    return view('postOffer');
    //widok panelu tworzenia oferty
});

Route::get('/recovery', function () {
    return view('recovery');
    //widok panelu odzyskiwania hasła
});