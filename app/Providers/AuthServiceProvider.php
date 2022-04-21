<?php

namespace App\Providers;
use Auth;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

       /* Auth::provider('external', function ($app, array $config) {
            return new ExternalApiUserProvider();
        });*/
/*
        $baseUrl = env('API_ENDPOINT');
        $this->app->singleton(Client::class, function($app) use ($baseUrl) {
            return new Client(['base_uri' => $baseUrl]);
        });
*/

    }

    public function register(){
        $this->app->singleton(ExternalApiUserProvider::class, function ($app) {
            return new ExternalApiUserProvider();
        });
    }
}
