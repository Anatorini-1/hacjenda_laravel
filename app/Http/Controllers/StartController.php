<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\User;

class StartController extends Controller
{
    public function index(){
        $offers = Offer::where('stan','otwarta')->orderBy('created_at','desc')->take(3)->get();
        return view('/start/index', ['offers' => $offers]);
    }
}
