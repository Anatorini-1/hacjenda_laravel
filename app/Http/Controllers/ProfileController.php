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
        $posted_standing_offers = Offer::where('user_id',$user->id)->where('zlecenie_stale','1')->where('stan','otwarta')->get();
        $posted_single_offers = Offer::where('user_id',$user->id)->where('zlecenie_stale','0')->where('stan','otwarta')->get();
        $employed_single = Active_offer::where('employer_id',$user->id)->get();
        $employed_standing = Active_standing_offer::where('employer_id',$user->id)->get();

        $acc_sin_offer_data = [];
        $acc_stan_offer_data = [];

        $empl_sin_offer_data = [];
        $empl_stan_offer_data = [];

        foreach ($accepted_standing_offers as $key => $value) {
            $employer = User::where('id',$value->employer_id)->get();
            $employer = [
                'id' => $employer['id'],
                'name'=> $employer['name']
            ];
            $offer = Offer::where('id', $value->offer_id)->get();
            $acc_stan_offer_data[] = [
                'employer' => $employer,
                'offer' => $offer,
                'accept_data' => $value
            ];
        }

        foreach ($accepted_single_offers as $key => $value) {
            $employer = User::where('id',$value->employer_id)->get();
            $employer = [
                'id' => $employer[0]['id'],
                'name'=> $employer[0]['name']
            ];
            $offer = Offer::where('id', $value->offer_id)->get();
            $acc_sin_offer_data[] = [
                'employer' => $employer,
                'offer' => $offer[0],
                'accept_data' => $value
            ];
        }

        foreach ($employed_single as $key => $value) {
            $employee = User::where('id',$value->employee_id)->get();
            $employee = [
                'id' => $employee[0]['id'],
                'name'=> $employee[0]['name']
            ];
            $offer = Offer::where('id', $value->offer_id)->get();
            $empl_sin_offer_data[] = [
                'employee' => $employee,
                'offer' => $offer[0],
                'accept_data' => $value
            ];
        }

        foreach ($employed_standing as $key => $value) {
            $employee = User::where('id',$value->employee_id)->get();
            $employee = [
                'id' => $employee[0]['id'],
                'name'=> $employee[0]['name']
            ];
            $offer = Offer::where('id', $value->offer_id)->get();
            $empl_stan_offer_data[] = [
                'employee' => $employee,
                'offer' => $offer[0],
                'accept_data' => $value
            ];
        }


        return view('users.myProfile',[
            'accepted_standing_offers' =>  $acc_stan_offer_data,
            'accepted_single_offers' =>  $acc_sin_offer_data,
            'posted_standing_offers' => $posted_standing_offers,
            'posted_single_offers' => $posted_single_offers,
            'employed_single_offers' => $empl_sin_offer_data,
            'employed_standing_offers' => $empl_stan_offer_data,
            ]);
        //widok profilu urzytkownika
    }

    public function show($id)
    {
        return view('users.show');
    }
}
