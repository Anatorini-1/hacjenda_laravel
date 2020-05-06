<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function postOffer(){
        return view('postOffer');
        //widok panelu tworzenia oferty
    }
}
