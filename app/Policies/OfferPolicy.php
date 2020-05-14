<?php

namespace App\Policies;

use App\Offer;
use App\User;
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
    public function __construct()
    {
        //
    }
   
    public function delete(User $user, Offer $offer)
    {
        if($user->id == $offer->user_id){
            return Response::allow('Access Granted');
        }
        else{
            return Response::deny('Access Forbidden');
        }
    }
    public function update(User $user, Offer $offer)
    {
        if($user->id == $offer->user_id){
            return true;
        }
        else{
            return false;
        }
    }
    
}
