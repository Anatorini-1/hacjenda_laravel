<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Offer;
use App\User;
use App\Active_offer;
use App\Active_standing_offer;
use App\Finished_offer;

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
        return view('offers.show', ['data' => $offer]);
    }

    public function store(){

        $offer = new Offer();

        $offer->miasto = request('miasto');
        $offer->adres = request('adres');
        $offer->okres_czasu = request('czas');
        $offer->do_kiedy = request('deadline');
        $offer->powierzchnia = request('powierzchnia');
        $offer->jobs = request('jobs');
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
                    return redirect("/offers/{$id}");
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
        var_dump($search);
        if($search==null){
        $offers = Offer::where('stan','otwarta')->orderBy('created_at',$sort)->get();
        }
        else{
        $offers = Offer::where('stan','otwarta')->where('miasto','LIKE',"%{$search}%")->orderBy('created_at',$sort)->get();
        var_dump($search);
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


    public function accept($id){
        $offer = Offer::findOrFail($id);
        $user = Auth::user();  
        $authorization = Gate::inspect('canAccept', $offer);
        error_log('siema'.$authorization);
        if($authorization->allowed()){
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
        if($authorization->denied()){
            return view('offers.accepted',[
                'msg' => $authorization->message(),
                'allowed' => false,
                ]);
        }
        }

}
