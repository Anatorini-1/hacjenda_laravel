<?php

namespace App\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
class DevPolicy
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
    public function admin_panel_access(User $user)
    {
        $usr_data = User::findOrFail($user->id);
       // error_log($usr_data->name);
       if($usr_data->access == 'admin' || $usr_data->access == 'master'){
        return Response::allow('Access Granted!');
       }
       else{
        return Response::deny('Access Denied!');
       }
    }
}
