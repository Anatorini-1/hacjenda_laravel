<?php

namespace App\Policies;

use App\Finished_offer;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Finished_offerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function review(User $user ,Finished_offer $offer)
    {
        if($user->id == $offer->employer_id){
            return true;
        }   
        else{
            return false;
        }
    }
}
