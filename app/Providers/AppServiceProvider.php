<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use App\Http\Middleware\EnsureAcceptJson;
use Illuminate\Auth\Notifications\ResetPassword;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        // Register CSRF middleware manually if needed
        $router->middlewareGroup('web', [
            // \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,  // Add the CSRF middleware
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        $router->middlewareGroup('api', [
            EnsureAcceptJson::class, // Add our custom middleware here
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        // Custom URL generation for the password reset link
        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            $url = URL::to('api/password/reset');
            return "{$url}?token={$token}&email=" . urlencode($notifiable->email);
        });
    }
}
