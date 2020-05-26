<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Offer;
use App\User;
use App\Active_offer;
use App\Active_standing_offer;
use App\Finished_offer;

class DevController extends Controller
{
    public function adminPanel(){
        $users = User::all();
        $offers = Offer::all();
        return view('dev.adminPanel',['users' => $users, 'offers' => $offers]);
        //widok panelu administratora
    }

    public function test(){
        
        return view('dev.test');
        //widok panelu odzyskiwania hasła
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
                $offer->cena = 69420;
                $offer->user_id='1';
                $offer->save();
             }
        return redirect('/dev/adminPanel');    
    }

    public function wipeOffers(){
        $offers = Offer::all();
        $active_offers = Active_offer::all();
        $active_standing_offers = Active_standing_offer::all();
        $finished_offers = Finished_offer::all();
        foreach ($offers as $offer) {
            $offer->delete();
        }

        foreach ($active_offers as $offer) {
            $offer->delete();
        }

        foreach ($active_standing_offers as $offer) {
            $offer->delete();
        }

        foreach ($finished_offers as $offer) {
            $offer->delete();
        }
        return redirect('/dev/adminPanel');
    }

    public function wipeUsers(){
        $users = User::all();
       
        foreach ($users as $user) {
            $user->delete();
        }
     
        return redirect('/dev/adminPanel');
    } 

    public function history(){
        $offers = Offer::orderBy('created_at')->get();
        return view('dev/history', ['offers' => $offers]);
    }
}
