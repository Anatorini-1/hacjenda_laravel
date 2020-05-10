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

    public function sample(){
        $miasta = ['Opole','Ozimek','Szczedrzyk','Warszawa','Szczecin','Gdańsk'];
        $adresy = ['Wiejska 45', 'Polna 5', 'Główna 66', 'Szkolna 56', 'Krótka 1', 'Najlepsza 420'];
        $czasy_pracy = ['1','2','3','4','5','6'];
        $deadline = ['2020-06-20','2020-07-12','2020-06-13','2020-07-01','2020-07-06','2020-08-27'];
        $powierzchnie = ['20','35','45','60','64','88'];

             for($i = 0; $i<5; $i++){
                $indexes = [
                    rand(0,5),
                    rand(0,5),
                    rand(0,5),
                    rand(0,5),
                    rand(0,5)
                ];
                error_log($indexes[0]);
                $offer = new Offer();
                $offer->miasto = $miasta[$indexes[0]];
                $offer->adres = $adresy[$indexes[1]];
                $offer->okres_czasu = $czasy_pracy[$indexes[2]];
                $offer->do_kiedy = $deadline[$indexes[3]];
                $offer->powierzchnia = $powierzchnie[$indexes[4]];
                $offer->jobs = ['1','2','3'];
                $offer->save();
             }
        return redirect('/dev/adminPanel');    
    }
}
