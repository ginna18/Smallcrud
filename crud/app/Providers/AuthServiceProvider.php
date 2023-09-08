<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\Planta' => 'App\Policies\PlantaPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
/* 
        $this->registerPolicies();
        VerifyEmail::toMailUsing(function($notifiable, $url){
            return (new MailMessage)
            ->subject('verificar email')
            ->greeting('hola')
            ->salutation('un saludo')
            ->line('haz clic en la siguiente linea para verificar tu email.')
            ->action('verificar email','$url');
        });
         */


        //
    }
}
