<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\User;

class DevController extends Controller
{
    public function adminPanel(){
        $users = User::all();
        $offers = Offer::all();
        return view('dev.adminPanel',['users' => $users, 'offers' => $offers]);
        //widok panelu administratora
    }

    public function test(){
        
        return view('dev.test');
        //widok panelu odzyskiwania hasła
    }
}
