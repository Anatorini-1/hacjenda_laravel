<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    
    public function myProfile(){
        return view('users.myProfile');
        //widok profilu urzytkownika
    }
}
