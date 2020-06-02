<?php

namespace App\Policies;

use App\Offer;
use App\User;
use App\Pending_offer;
use App\Active_offer;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Http\Controllers\Auth;
use Illuminate\Auth\Access\Response;

class OfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function __construct(){

            //
        }
   

    public function delete(User $user, Offer $offer){
            if($user->id == $offer->user_id){
                if($offer->stan =='otwarta'){
                    return Response::allow('Access Granted');
                }
            }        
                return Response::deny('Access Forbidden');
        }

    public function update(User $user, Offer $offer){
            if($user->id == $offer->user_id){
                return true;
            }
            return false;
        }
    public function apply(User $user ,Offer $offer){
            if($offer->stan == 'w_realizacji'){
                return Response::deny('Oferta jest w realizacji');
            }
            else if($offer->stan == 'zakonczona'){
                return Response::deny('Oferta została zrealizowana');
            }

            else if($user->id == $offer->user_id){
                return Response::deny('Oczekuje na wykonawcę');
            }
           

           
            else if($user->access == 'suspended'){
                return Response::deny('Twoje konto zostało zawieszone. Jeśli uważasz że jest to spowodowane błędem, skontaktuj się z supportem');
            }
            
            else if(Pending_offer::where('user_id',$user->id)->where('offer_id',$offer->id)->get()->count() > 0){
                return Response::deny('Już zgłosiłeś się do realizacji tej oferty');
            }
            else{
                return Response::allow();
            }
           
        }
    public function accept(User $user, Offer $offer){
        if($user->access == 'suspended'){
            return Response::deny('Konto użytkownika zostało zawieszone i nie może on przyjąć oferty');
        }
        else{
            return Response::allow();
        }
    }
    public function employ(User $user, Offer $offer)
    {
        if($user->id == $offer->user_id){
            return Response::allow();
        }
        else{
            return Response::deny('Nie możesz');
        }
    }
    public function finish(User $user, Offer $offer)
    {
      $active = Active_offer::where('offer_id', $offer->id)->get();
      $active = $active[0];
      if($active->employer_id == $user->id){
        return true;
      }
      else{
          return false;
      }
    }

    public function before(User $user){
        if($user->access == 'master'){
            return Response::allow('Admin Access Granted');
        }
        }
}

