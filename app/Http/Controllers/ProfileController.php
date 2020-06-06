<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Offer;
use App\User;
use App\Active_offer;
use App\Active_standing_offer;
use App\Finished_offer;
use App\Opinion;

class ProfileController extends Controller
{
    public function index()
    {
        $finished_offers = Finished_offer::all();
        $users = [];
        $users_data = [];
        foreach ($finished_offers as $offer) {
            if (isset($users[$offer->employee_id])){
                $users[$offer->employee_id] += 1;
            }
            else{
                $users[$offer->employee_id] = 1;
            }
        }
       arsort($users);
        foreach ($users as $id => $finished) {
            $opinions = Opinion::where('user_id',$id)->get();
            $sum = 0;
            $count = 0;
            foreach ($opinions as $opinion) {
               $sum += $opinion->ocena;
                   $count++;
            }
            $avg = $sum/$count;
            $users_data[] = [
                'user' => User::find($id),
                'finished' =>$finished,
                'avg' => $avg,
            ];
        }
       
        return view('users.index',['users' => $users_data]);
    }

    public function myProfile(){
        $user = Auth::user();
        
        $accepted_single_offers = Active_offer::where('employee_id',$user->id)->get();
      
        $posted_single_offers = Offer::where('user_id',$user->id)->where('zlecenie_stale','0')->where('stan','otwarta')->get();
        $employed_single = Active_offer::where('employer_id',$user->id)->get();
       

        $jobs_done = Finished_offer::where('employee_id',$user->id)->get();
        $jobs_ordered = Finished_offer::where('employer_id',$user->id)->get();

        $acc_sin_offer_data = [];
       

        $empl_sin_offer_data = [];
       

        $jobs_done_data = [];
        $jobs_ordered_data = [];

       

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

       

        foreach ($jobs_done as $key => $value) {
            $opinion = Opinion::find($value->opinion_id);
            $employer = User::find($value->employer_id);
            $jobs_done_data[] = [
                'opinion' => $opinion->opinia ?? '-',
                'employer' => $employer,
                'offer' => $value,
            ];
        }
        foreach ($jobs_ordered as $key => $value) {
            $opinion = Opinion::find($value->opinion_id);
            $employee = User::find($value->employee_id);
            $jobs_ordered_data[] = [
                'opinion' => $opinion->opinia ?? '-',
                'employee' => $employee,
                'offer' => $value,
            ];
        }


        return view('users.myProfile',[
          
            'accepted_single_offers' =>  $acc_sin_offer_data,
         
            'posted_single_offers' => $posted_single_offers,
            'employed_single_offers' => $empl_sin_offer_data,
          
            'jobs_done' => $jobs_done_data,
            'jobs_ordered' => $jobs_ordered_data,
            ]);
        //widok profilu urzytkownika
    }

    public function show($id)
    {
        $user = User::FindOrFail($id);
        $data_to_show = [];
        $offer_data_to_show = [];
        $finished = Finished_offer::where('employee_id',$user->id)->orderBy('finished_at','desc')->limit(5)->get();
        foreach ($finished as $offer) {
           $offer_data = Offer::find($offer->offer_id);
           $employer = User::find($offer_data->user_id);
           $opinia = Opinion::where('id',$offer->opinion_id)->get();
  // var_dump($opinia);
           $offer_data_to_show[] = [
               'employer'=>$employer,
               'offer'=>$offer_data,
               'finished'=>$offer,
               'opinion'=>$opinia,
           ];
        }
        //Profile data
            $data_to_show['name'] = $user->name;
            $data_to_show['full_name'] = $user->full_name;
            $data_to_show['profile_picture'] = $user->profile_picture;
            $data_to_show['desc'] = $user->desc;
            $data_to_show['city'] = $user->city;
        //Offer Data
            $data_to_show['finished_offers'] = Finished_offer::where('employee_id',$user->id)->count();
            $data_to_show['active_offers'] = Active_offer::where('employee_id',$user->id)->count();
           
        return view('users.show', ['data' => $data_to_show, 'offers'=>$offer_data_to_show]);
    }

    public function update()
    {
        return view('users/update');
    }

    public function save_update(Request $request)
    {
        
      
       $user = Auth::user();
        
        $validated_data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name,'.$user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'name-surname' => ['required','string'],
            'city' => ['required', 'string'],
            
            ]);
            $user->name = $validated_data['name'];
            $user->full_name = $validated_data['name-surname'];
            $email = $user->email;
            if($email != $validated_data['email']){
                $user->email = $validated_data['email'];
                $user->email_verified_at = null;
                $user->city = $validated_data['city'];
                $user->desc = request('desc') ?? '-';
                $user->save();
                Auth::logout();
                return redirect('/');
            }
           
            $user->city = $validated_data['city'];
            $user->desc = request('desc') ?? '-';
            $user->save();
       
        return redirect('/users/myProfile')->with('msg','Zapisano zmiany');
    }
}
