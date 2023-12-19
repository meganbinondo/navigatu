<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('ph_mobile', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^09[0-9]{9}$/', $value) === 1;
        });
    }
}