<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function login(){
        return view('users.login');
        //panel logowania/rejestracji
    }
    public function myProfile(){
        return view('users.myProfile');
        //widok profilu urzytkownika
    }

    public function recovery(){
        return view('users.recovery');
        //widok panelu odzyskiwania hasła
    }
}
