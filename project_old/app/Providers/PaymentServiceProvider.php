<?php

namespace App\Providers;

use App\PaymentService\PayPalApi;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider // ServiceProvider is an abstract class that provides implementation
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    // any service start and powerup then use boot
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */

    // any services bind with class then use register
    public function register()
    {
        // $this->app->bind(PayPalApi::class, function() {
        //     return new PayPalApi("code-".rand(0, 1500));
        // });

        // 1- for control multiple instance in provider -----
        // $this->app->bind(PayPalApi::class, function() {
        //     return new PayPalApi("code-".rand(0, 1500));
        // }, true);

        // 2- for control multiple instance in provider -----
        
        $paypal = new PayPalApi("code-".rand(0, 1500));
        $this->app->instance(PayPalApi::class, $paypal);
    }
}
