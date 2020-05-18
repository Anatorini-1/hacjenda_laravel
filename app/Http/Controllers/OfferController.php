<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class OfferController extends Controller
{
    public function index($id = 1){
        $items_per_page = 6;
        $offers = Offer::all();
        
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
        $search = request('search');
        $items_per_page = 6;
        $offers = Offer::where('miasto',$search)->get();
        
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
            'activesearch' => "?search=".$search,
            'activePage' => $active_page,
            'search' => $search
            ]);
    }

}
