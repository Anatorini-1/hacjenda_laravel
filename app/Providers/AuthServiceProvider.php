<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Policies\OfferPolicy;
use App\Policies\DevPolicy;
use App\Policies\Finished_offerPolicy;
use App\Offer;
use App\Finished_offer;
use App\User;
use App\Dev;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Offer::class => OfferPolicy::class,
       Dev::class => DevPolicy::class,
       Finished_offer::class => Finished_offerPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
   
        
    }
}
