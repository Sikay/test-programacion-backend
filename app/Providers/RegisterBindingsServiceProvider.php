<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Hoyvoy\Currencies\Infrastructure\Bindings\CurrenciesRegisterBindings;
use Hoyvoy\Currencies\Application\Subscriber\SendEmailUpdateCurrenciesSubscriber;

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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
