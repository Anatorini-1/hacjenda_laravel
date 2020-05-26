<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Offer;
use App\User;
use App\Active_offer;
use App\Active_standing_offer;
use App\Finished_offer;
use App\Pending_offer;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;


class OfferController extends Controller
{
    public function index($id = 1){
        $items_per_page = 6;
       
        $offers = Offer::where('stan','otwarta')->get();
        
        $toDisplay = [];
        $pageCounter = floor((sizeof($offers)/$items_per_page))+1;
        $active_page = $id;
        if($active_page > $pageCounter || $active_page < 1){
            return abort(404);
        }
        $id--;
        for ($i=$items_per_page*$id; $i < $items_per_page*($id+1) ; $i++) {
            if(isset($offers[$i])){
               $toDisplay[] = $offers[$i];
            }
            
             
        }
        
        return view('offers.index',[
            'data' => $toDisplay, 
            'pageCount' => $pageCounter, 
            'activePage' => $active_page,
            'activesearch' => "",
            'beforesearch' => '',
            ]);
    }

    public function create(){
     
        return view('offers.create');
  
    }
    
    public function show($id){
        $offer = Offer::findOrFail($id);
        $pending = Pending_offer::where('offer_id',$offer->id)->get();
        $pending_users = [];
        foreach ($pending as $key => $value) {
            $user = User::where('id',$value->user_id)->get()[0];
            $pending_users[] = $user;
        }
        return view('offers.show', [
            'data' => $offer,
            'pending' => $pending_users,
            ]);
    }

    public function store(){

        $offer = new Offer();

        $offer->miasto = request('miasto');
        $offer->adres = request('adres');
        $offer->okres_czasu = request('czas');
        $offer->do_kiedy = request('deadline');
        $offer->powierzchnia = request('powierzchnia');
        if(null !=request('jobs')){
            $offer->jobs = request('jobs');
        }
        else{
            $offer->jobs = [];
        }
        $offer->user_id = Auth::user()->id;
        $offer->uwagi = request('uwagi');               
        $offer->cena = request('cena');
        if(request('zlecenie_stale') == 'on'){
            $offer->czestotliwosc = request('czestotliwosc') ?? '';
            $offer->zlecenie_stale = true;
        }
        else{
            $offer->zlecenie_stale = false;
        }
        
        $offer->save();
        return redirect('/offers')->with('msg', "Order Registered");

    }

    public function destroy($id){
        $offer = Offer::findOrFail($id); 
        $this->authorize('delete',$offer);
        $offer->delete();

        return redirect('/offers');
    }

    public function update($id)
        {
            $offer = Offer::FindOrFail($id);
            if( Auth::user()->can('update',$offer)){
                return view('offers.update', ['data'=>$offer]);
            }
            else{
                return abort(403);
            }
        }

    public function save_update($id)
        {
            $offer = Offer::FindOrFail($id);
                if( Auth::user()->can('update',$offer)){
                    $offer->miasto = request('miasto');
                    $offer->adres = request('adres');
                    $offer->okres_czasu = request('okres_czasu');
                    $offer->do_kiedy = request('do_kiedy');
                    $offer->powierzchnia = request('powierzchnia');               
                    $offer->jobs = request('jobs');
                    $offer->save();
                    return redirect("/offers/show/{$id}");
                }
                else{
                    return abort(403);
                }
        }

    public function search($id = 1){
        //http://127.0.0.1:8000/offers/search/?search=Warszawa
        //$url_components = parse_url($url); 
        $search = request('search');
        $sort = request('sort');
        if($search==null){
        $offers = Offer::where('stan','otwarta')->orderBy('created_at',$sort)->get();
        }
        else{
        $offers = Offer::where('stan','otwarta')->where('miasto','LIKE',"%{$search}%")->orderBy('created_at',$sort)->get();
        }
        $items_per_page = 6;
        $toDisplay = [];
        $pageCounter = floor((sizeof($offers)/$items_per_page))+1;
        $active_page = $id;
        if($active_page > $pageCounter || $active_page < 1){
            return abort(404);
        }
        $id--;
        for ($i=$items_per_page*$id; $i < $items_per_page*($id+1) ; $i++) {
            if(isset($offers[$i])){
               $toDisplay[] = $offers[$i];
            }
            
             
        }
        
        
        return view('offers.index',[
            'data' => $toDisplay, 
            'pageCount' => $pageCounter, 
            'beforesearch' => 'search/',
            'activesearch' => "?search=".$search."&sort=".$sort,
            'activePage' => $active_page,
            'search' => $search,
            'sort' => $sort,
            ]);
    }

    public function pending_accept($id)
    {
        $offer = Offer::findOrFail($id);
        $user = Auth::user(); 
        $authorization = Gate::inspect('apply', $offer);
        if($authorization->allowed()){
            $pending_accept = new Pending_offer();
            $pending_accept->user_id = $user->id;
            $pending_accept->offer_id = $offer->id;
            $pending_accept->save();
            return redirect("/offers/show/$offer->id")->with('msg','Przyjęto zgloszenie. Oczekujesz na odpowiedź zleceniodawcy');
           
        }
        else{
            return view('offers.accepted',[
                'msg' => $authorization->message(),
                'allowed' => false,
                ]);
        }
    }
/*
    public function accept($offer_id, $user_id){
        $offer = Offer::findOrFail($offer_id);
        $user = Auth::user();
        $employee = User::findOrFail($user_id);
        $authorization_employee = Gate::inspect('canAccept',$employee, $offer);
        $authorization_user = Gate::inspect('update',$offer);
        error_log('siema'.$authorization_employee);
        if($authorization_employee->allowed()){
            if($authorization_user->allowed()){   
                if($offer->zlecenie_stale == 1){
                    $activated = new Active_standing_offer();
                }
                else{
                    $activated = new Active_offer();
                }

                $activated->id = null;
                $activated->offer_id = $offer->id;
                $activated->employer_id = $offer->user_id;
                $activated->employee_id = $user->id;
                $activated->accepted_at = Carbon::now();
                $offer->stan = 'w_realizacji';
                $activated->save();
                $offer->save();
                if($offer->zlecenie_stale == 1){
                    $activated =Active_standing_offer::all();
                    $activated = $activated[sizeof($activated)-1];
                    $json = $user->active_standing_orders;
                    $arr = json_decode($json,true);
                    $arr[] = $activated->id;
                    error_log($arr);
                    $user->active_standing_orders = $arr;
                    $user->save();
                }
                else{
                    $activated =Active_offer::all();
                    $activated = $activated[sizeof($activated)-1];
                
                    $json = $user->active_single_orders;
                    $arr = json_decode($json,true);
                    $arr[] = $activated->id;
                    
                    $user->active_single_orders = $arr;
                    $user->save();
                }
                
                
                return view('offers.accepted',[
                'msg' => $authorization->message(),
                'allowed' => true,
                ]);
        }
        }
        if($authorization_employee->denied()){
            return view('offers.accepted',[
                'msg' => $authorization_employee->message(),
                'allowed' => false,
                ]);
        }
        }
*/


public function accept($offer_id, $user_id)
{
   
    $employer = Auth::user();
    $employee = User::FindOrFail($user_id);
    $offer = Offer::FindOrFail($offer_id);
    $access = Gate::inspect('employ', $offer);
    if($access->allowed()){
        if($offer->clecenie_stale == 1){
            $new_entry = new Active_standing_offer();
            if(Active_staning_offer::where('employee_id',$employee->id)->where('offer_id',$offer->id)->count() > 0){
                return view('offers.accepted',[
                    'msg' => 'Oferta już została zatwierdzona',
                    'allowed' => false,
                    ]); 
            }
        }
        if($offer->zlecenie_Stale == 0){
            $new_entry = new Active_offer();
            if(Active_offer::where('employee_id',$employee->id)->where('offer_id',$offer->id)->count() > 0){
                return view('offers.accepted',[
                    'msg' => 'Oferta już została zatwierdzona',
                    'allowed' => false,
                    ]); 
            }
        }
        $new_entry->offer_id = $offer->id;
        $new_entry->employee_id = $employee->id;
        $new_entry->employer_id = $employer->id;
        $new_entry->accepted_at = Carbon::now();
        $offer->stan = 'w_realizacji';
        $offer->save();
        $new_entry->save();

        if($offer->zlecenie_stale == 1){
            $activated =Active_standing_offer::all();
            $activated = $activated[sizeof($activated)-1];
            $json = $employee->active_standing_orders;
            $arr = json_decode($json,true);
            $arr[] = $activated->id;
            error_log($arr);
            $employee->active_standing_orders = $arr;
            $employee->save();
        }
        else{
            $activated =Active_offer::all();
            $activated = $activated[sizeof($activated)-1];
        
            $json = $employee->active_single_orders;
            $arr = json_decode($json,true);
            $arr[] = $activated->id;
            
            $employee->active_single_orders = $arr;
            $employee->save();
        }

        $to_del = Pending_offer::where('offer_id',$offer->id)->get();
        foreach ($to_del as $key => $value) {
            $value->delete();
        }
        return view('offers.accepted',[
            'msg' => $access->message(),
            'allowed' => true,
            ]);
    }
    else{
        return view('offers.accepted',[
            'msg' => $access->message(),
            'allowed' => false,
            ]);
    }
        
}
}