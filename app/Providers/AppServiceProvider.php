<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // after_inclusiveルールを追加
        Validator::extend('after_inclusive', function ($attribute, $value, $parameters, $validator) {
            $after = $parameters[0];

            return strtotime($value) >= strtotime($after);
        });

        Validator::replacer('after_inclusive', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':after', $parameters[0], $message);
        });

        // before_inclusiveルールを追加
        Validator::extend('before_inclusive', function ($attribute, $value, $parameters, $validator) {
            $before = $parameters[0];

            return strtotime($value) <= strtotime($before);
        });

        Validator::replacer('before_inclusive', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':before', $parameters[0], $message);
        });
    }
}
