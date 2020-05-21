<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Offer;
use App\User;
use App\Active_offer;
use App\Active_standing_offer;
use App\Finished_offer;

class ProfileController extends Controller
{
    
    public function myProfile(){
        $user = Auth::user();
        $accepted_standing_offers = Active_standing_offer::where('employee_id',$user->id)->get();
        $accepted_single_offers = Active_offer::where('employee_id',$user->id)->get();
        $posted_standing_offers = Offer::where('user_id',$user->id)->where('zlecenie_stale','1')->get();
        $posted_single_offers = Offer::where('user_id',$user->id)->where('zlecenie_stale','0')->get();

        $acc_sin_offer_data = [];
        $acc_stan_offer_data = [];
        $pst_sin_offer_data = [];
        $pst_stan_offer_data = [];

        foreach ($accepted_standing_offers as $key => $offer) {
           $employer = User::where();
        }





        return view('users.myProfile',[
            'accepted_standing_offers' => $accepted_standing_offers,
            'accepted_single_offers' => $accepted_single_offers,
            'posted_standing_offers' => $posted_standing_offers,
            'posted_single_offers' => $posted_single_offers,
            ]);
        //widok profilu urzytkownika
    }
}
