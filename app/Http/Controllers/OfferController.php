<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Offer;
use App\User;
use App\Active_offer;

use App\Finished_offer;
use App\Pending_offer;
use App\Opinion;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;


class OfferController extends Controller
{
    public function index($id = 1)
    {
        $items_per_page = 6;

        $offers = Offer::where('stan', 'otwarta')->get();

        $toDisplay = [];
        $pageCounter = floor((sizeof($offers) / $items_per_page)) + 1;
        $active_page = $id;
        if ($active_page > $pageCounter || $active_page < 1) {
            return abort(404);
        }
        $id--;
        for ($i = $items_per_page * $id; $i < $items_per_page * ($id + 1); $i++) {
            if (isset($offers[$i])) {
                $toDisplay[] = $offers[$i];
            }
        }

        return view('offers.index', [
            'data' => $toDisplay,
            'pageCount' => $pageCounter,
            'activePage' => $active_page,
            'activesearch' => "",
            'beforesearch' => '',
        ]);
    }

    public function create()
    {

        return view('offers.create');
    }

    public function show($id)
    {
        $offer = Offer::findOrFail($id);
        $pending = Pending_offer::where('offer_id', $offer->id)->get();
        $pending_users = [];
        foreach ($pending as $key => $value) {
            $user = User::where('id', $value->user_id)->get()[0];
            $pending_users[] = $user;
        }
        return view('offers.show', [
            'data' => $offer,
            'pending' => $pending_users,
        ]);
    }
 
    
    public function store(Request $request)
    {

        $offer = new Offer();
       
        $validated_data = $request->validate([
            'miasto'=>'required|string',
            'adres'=>'required|string',
            'okres_czasu'=>'required|string',
            'do_kiedy'=>'required|date',
            'powierzchnia' => 'required|numeric',
            'cena'=>'required|numeric',

        ]);
        $offer->miasto = request('miasto');
        $offer->adres = request('adres');
        $offer->okres_czasu = request('okres_czasu');
        $offer->do_kiedy = request('do_kiedy');
        $offer->powierzchnia = request('powierzchnia');
        if (null != request('jobs')) {
            $offer->jobs = request('jobs');
        } else {
            $offer->jobs = [];
        }
        $offer->user_id = Auth::user()->id;
        $offer->uwagi = request('uwagi');
        $offer->cena = request('cena');

        $offer->save();
        return redirect('/offers')->with('msg', "Utworzono ofertę");
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $access = Gate::inspect('delete', $offer);
        if ($access) {
            $offer->delete();
            return redirect('/offers')->with('msg','Usunięto ofertę');
        } else {
            return abort(403);
        }
    }

    public function update($id)
    {
        $offer = Offer::FindOrFail($id);
        if (Auth::user()->can('update', $offer)) {
            return view('offers.update', ['data' => $offer]);
        } else {
            return abort(403);
        }
    }

    public function save_update($id)
    {
        $offer = Offer::FindOrFail($id);
        if (Auth::user()->can('update', $offer)) {
            $offer->miasto = request('miasto');
            $offer->adres = request('adres');
            $offer->okres_czasu = request('okres_czasu');
            $offer->do_kiedy = request('do_kiedy');
            $offer->powierzchnia = request('powierzchnia');
            if (null != request('jobs')) {
                $offer->jobs = request('jobs');
            } else {
                $offer->jobs = [];
            }
            $offer->save();
            return redirect("/offers/show/{$id}")->with('msg','Zapisano zmiany');
        } else {
            return abort(403);
        }
    }

    public function search($id = 1)
    {
        //http://127.0.0.1:8000/offers/search/?search=Warszawa
        //$url_components = parse_url($url); 
        $search = request('search');
        $sort = request('sort');
        $praca = request('np');
        if($sort=="")
            $sort = 'desc';
        $cenaod = request('cenaod');
        $cenado = request('cenado');
        if($cenaod == null)
            $cenaod = 0;
        if($cenado == null)
            $cenado = 99899;
        if ($search == null && $praca == null) {
            $offers = Offer::where('stan', 'otwarta')->whereRaw("cena >= $cenaod")->whereRaw("cena <= $cenado")->orderBy('created_at', $sort)->get();
        }else if($praca == null){
            $offers = Offer::where('stan', 'otwarta')->where('miasto', 'LIKE', "%{$search}%")->whereRaw("cena >= $cenaod")->whereRaw("cena <= $cenado")->orderBy('created_at', $sort)->get();
        } else if($search == null){
            $offers = Offer::where('stan', 'otwarta')->where('jobs', 'LIKE',  "%\"$praca\"%")->whereRaw("cena >= $cenaod")->whereRaw("cena <= $cenado")->orderBy('created_at', $sort)->get();
        }else{
            $offers = Offer::where('stan', 'otwarta')->where('miasto', 'LIKE', "%{$search}%")->where('jobs', 'LIKE',  "%\"$praca\"%")->whereRaw("cena >= $cenaod")->whereRaw("cena <= $cenado")->orderBy('created_at', $sort)->get();
        }
        $items_per_page = 6;
        $toDisplay = [];
        $pageCounter = floor((sizeof($offers) / $items_per_page)) + 1;
        $active_page = $id;
        if ($active_page > $pageCounter || $active_page < 1) {
            return abort(404);
        }
        $id--;
        for ($i = $items_per_page * $id; $i < $items_per_page * ($id + 1); $i++) {
            if (isset($offers[$i])) {
                $toDisplay[] = $offers[$i];
            }
        }

        return view('offers.index', [
            'data' => $toDisplay,
            'pageCount' => $pageCounter,
            'beforesearch' => 'search/',
            'activesearch' => "?search=" . $search . "&sort=" . $sort . "&np=" . $praca . "&cenaod=" . $cenaod . "&cenado=" . $cenado,
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
        if ($authorization->allowed()) {
            $pending_accept = new Pending_offer();
            $pending_accept->user_id = $user->id;
            $pending_accept->offer_id = $offer->id;
            $pending_accept->save();
            return redirect("/offers/show/$offer->id")->with('msg', 'Przyjęto zgloszenie. Oczekujesz na odpowiedź zleceniodawcy');
        } else {
            return view('offers.accepted', [
                'msg' => $authorization->message(),
                'allowed' => false,
            ]);
        }
    }

    public function accept($offer_id, $user_id)
    {

        $employer = Auth::user();
        $employee = User::FindOrFail($user_id);
        $offer = Offer::FindOrFail($offer_id);
        $access = Gate::inspect('employ', $offer);
        if ($access->allowed()) {
                $new_entry = new Active_offer();
                if (Active_offer::where('employee_id', $employee->id)->where('offer_id', $offer->id)->count() > 0) {
                    return view('offers.accepted', [
                        'msg' => 'Oferta już została zatwierdzona',
                        'allowed' => false,
                    ]);
                }
            $new_entry->offer_id = $offer->id;
            $new_entry->employee_id = $employee->id;
            $new_entry->employer_id = $employer->id;
            $new_entry->accepted_at = Carbon::now();
            $offer->stan = 'w_realizacji';
            $offer->save();
            $new_entry->save();

            
            
                $activated = Active_offer::all();
                $activated = $activated[sizeof($activated) - 1];

                $json = $employee->active_single_orders;
                $arr = json_decode($json, true);
                $arr[] = $activated->id;

                $employee->active_single_orders = $arr;
                $employee->save();
            

            $to_del = Pending_offer::where('offer_id', $offer->id)->get();
            foreach ($to_del as $key => $value) {
                $value->delete();
            }
            return view('offers.accepted', [
                'msg' => $access->message(),
                'allowed' => true,
            ]);
        } else {
            return view('offers.accepted', [
                'msg' => $access->message(),
                'allowed' => false,
            ]);
        }
    }

    public function finish($id)
    {
        $data = [];
        $offer = Offer::findOrFail($id);
       
       
            $target = Active_offer::where('offer_id',$offer->id)->get();
            $target = $target[0];
        
        $user = Auth::user();
    
    
        if($user->id == $target->employer_id){
            $target->employer_finished = 1;
        }
        else{
            return abort(403);
        }
        $target->save();
        /*Ok. Jeśli zastanawia się Pan dlaczego to jest zrobione tak a nie ianczej, już wyjaśniam. 
        //wstępnie kończenie oferty miało być mechanizmem dwu-etapowym. Wymagał potwierdzenia wykonawcy i pracodawcy. A potem się rozmyśliliśmy
        ale nikomu już sie nie chciało pisać od nowa metody która działa.*/
        if($target->employer_finished == 1){
                if($user->id == $target->employer_id){
                    $data['msg'] = 'Oferta Została zakończona. Czy chciałbyś wystawić ocenę wykonawcy?';
                    
                    $data['employer'] = true;
                }
                
                $finished = new Finished_offer();
                $finished->offer_id = $offer->id;
                $finished->employee_id = $target->employee_id;
                $finished->employer_id = $target->employer_id;
                $finished->accepted_at = $target->created_at;
                $finished->finished_at = Carbon::now();
                $finished->save();
                $target->delete();
                $offer->stan = 'zakonczona';
                $offer->save();
                $data['id'] = $finished->id;
                $data['standing'] = false;
                
            }
        return view('offers.finished', ['data'=>$data]);
    }

    public function finished($id = 1)
    {
        $items_per_page = 6;
        $search = request('search');
        $sort = request('sort');
        $praca = request('praca');
        if($sort=="")
            $sort = 'desc';
        $cenaod = request('cenaod');
        $cenado = request('cenado');
        if(is_string($cenaod)==true)
            $cenaod = null;
            if(is_string($cenado)==true)
            $cenado = null;
        if($cenaod == null)
            $cenaod = 0;
        if($cenado == null)
            $cenado = 99999;
        if ($search == null && $praca == null) {
            $offers = Offer::where('stan', 'zakonczona')->whereRaw("cena >= $cenaod")->whereRaw("cena <= $cenado")->orderBy('created_at', $sort)->get();
        }else if($praca == null){
            $offers = Offer::where('stan', 'zakonczona')->where('miasto', 'LIKE', "%{$search}%")->whereRaw("cena >= $cenaod")->whereRaw("cena <= $cenado")->orderBy('created_at', $sort)->get();
        } else if($search == null){
            $offers = Offer::where('stan', 'zakonczona')->where('jobs', 'LIKE',  "%\"$praca\"%")->whereRaw("cena >= $cenaod")->whereRaw("cena <= $cenado")->orderBy('created_at', $sort)->get();
        }else{
            $offers = Offer::where('stan', 'zakonczona')->where('miasto', 'LIKE', "%{$search}%")->where('jobs', 'LIKE',  "%\"$praca\"%")->whereRaw("cena >= $cenaod")->whereRaw("cena <= $cenado")->orderBy('created_at', $sort)->get();
        }
        $toDisplay = [];
        $pageCounter = floor((sizeof($offers) / $items_per_page)) + 1;
        $active_page = $id;
        if ($active_page > $pageCounter || $active_page < 1) {
            return abort(404);
        }
        $id--;
        for ($i = $items_per_page * $id; $i < $items_per_page * ($id + 1); $i++) {
            if (isset($offers[$i])) {
                $toDisplay[] = $offers[$i];
            }
        }

        return view('offers.finished_offers', [
            'data' => $toDisplay,
            'pageCount' => $pageCounter,
            'beforesearch' => '',
            'activesearch' => "?search=" . $search . "&sort=" . $sort . "&np=" . $praca . "&cenaod=" . $cenaod . "&cenado=" . $cenado,
            'activePage' => $active_page,
            'activePage' => $active_page,
            'search' => $search,
            'sort' => $sort,
        ]);
    }

    public function review($id)
    {
        $user = Auth::user();
        $offer = Finished_offer::find($id);
        $access = Gate::allows('review', $offer);
        if($access){
            return view('offers.review',['id'=>$offer->id]);
        }
        else{
            return abort(403);
        }
        
    }

    public function store_review($id, Request $request)
    {
        $finished_offer = Finished_offer::find($id);
        $request->validate([
            'opinia' => 'required|max:255',
        ]);
        if(Gate::allows('review', $finished_offer)){
            $opinion = new Opinion();
            $opinion->opinia = request('opinia');
            $opinion->ocena = request('ocena');
            $opinion->user_id = $finished_offer->employee_id;
            $opinion->offer_id = $finished_offer->offer_id;
            $opinion->save();
            $finished_offer->opinion_id = $opinion->id;
            $finished_offer->save();
            return redirect('/')->with('msg','Zapisano opinię');
        }
        else{
            return abort(403);
        }
        
    }

    
}
