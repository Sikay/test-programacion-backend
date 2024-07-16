<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RegisterBindingsServiceProviders extends ServiceProvider
{
    protected array $providers = [

    ];

    /**
     * Registrar los bindings de la aplicación
     */
    public function register()
    {
        foreach ($this->providers as $key => $value) {
            is_numeric($key)
                ? $this->app->singleton($value)
                : $this->app->singleton($key, $value);
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
