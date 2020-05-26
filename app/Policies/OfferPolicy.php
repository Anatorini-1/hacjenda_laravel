<?php

namespace App\Policies;

use App\Offer;
use App\User;
use App\Pending_offer;
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
                return Response::allow('Access Granted');
            }
            else{
                return Response::deny('Access Forbidden');
            }
        }

    public function update(User $user, Offer $offer){
            if($user->id == $offer->user_id){
                return true;
            }
            else{
                return false;
            }
        }
    public function apply(User $user ,Offer $offer){
            if($offer->stan != 'otwarta'){
                return Response::deny('Oferta nie może zostać przyjęta!');
            }

            else if($user->id == $offer->user_id){
                return Response::deny('Nie możesz przyjąć własnej oferty!');
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


    public function before(User $user){
        if($user->access == 'master'){
            return Response::allow('Admin Access Granted');
        }
        }
}

