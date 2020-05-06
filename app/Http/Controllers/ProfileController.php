<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function login(){
        return view('login');
        //panel logowania/rejestracji
    }
    public function myProfile(){
        return view('myProfile');
        //widok profilu urzytkownika
    }

    public function recovery(){
        return view('recovery');
        //widok panelu odzyskiwania hasła
    }
}
