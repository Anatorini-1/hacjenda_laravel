<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //tu tworzymy funkcje wywoływane przez Route Handeler

    public function index() {
        //przykładowe dane, w założeniu pobrane z bazy
    
        $data = [
            'numer' => 0,
            'author' => "Anatorini",
            'desc' => "Some random string idk",
        ];

        return view('home', $data);
        //Strona główna, htaccess przekierowuje domyślnie na ten widok

    }
    
}
