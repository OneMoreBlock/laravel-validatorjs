<?php

namespace OneMoreBlock\Validatorjs;

use Illuminate\Support\ServiceProvider;

class ValidatorJsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ .'/../js/validatorjs.js' => public_path('vendor/laravel-validator-js.js'),
            __DIR__ .'/../config/validatorjs.php' => config_path('validatorjs.php')
        ]);
    }

    public function register()
    {

    }
}
