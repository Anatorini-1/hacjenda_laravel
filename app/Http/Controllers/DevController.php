<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DevController extends Controller
{
    public function adminPanel(){
        return view('adminPanel');
        //widok panelu administratora
    }

    public function test(){
        return view('test');
        //widok panelu odzyskiwania hasła
    }
}
