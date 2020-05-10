<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offer;


class OfferController extends Controller
{
    public function index(){
     $offers = Offer::all();
     return view('offers.index',['data' => $offers]);
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
        $offer->save();
        return redirect('/offers')->with('msg', "Order Registered");

    }

    public function destroy($id){
        $offer = Offer::findOrFail($id); 
        $offer->delete();
        return redirect('/offers');
    }

}
