<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Hoyvoy\Currencies\Infrastructure\Bindings\CurrenciesRegisterBindings;

class RegisterBindingsServiceProvider extends ServiceProvider
{
    protected array $packagesBindingsRegister = [
        CurrenciesRegisterBindings::class,
    ];

    /**
     * Registrar los bindings de la aplicación
     */
    public function register()
    {

        foreach ($this->packagesBindingsRegister as $packageRegister) {
            $bindings = new $packageRegister($this->app);
            foreach ($bindings->singletons() as $key => $value) {
                $this->app->singleton($key, $value);
            }
        }

        $this->app->tag(
            SendEmailUpdateCurrenciesSubscriber::class,
            'domain_event_subscriber'
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
