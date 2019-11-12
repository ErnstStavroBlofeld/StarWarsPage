<?php

namespace App\Providers;

use App\Service\StarWars\SWApiService;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Str::macro('join', function (string $glue, array $pieces) {
            return \implode($glue, $pieces);
        });

        Str::macro('split', function (string $delimiter, string $string) {
            return \explode($delimiter, $string);
        });

        Str::macro('match', function (string $regex, string $text) {
            \preg_match($regex, $text, $parts);
            return $parts;
        });

        Collection::macro('recursive', function () {
            return $this->map(function ($value) {
                if (is_array($value) || is_object($value)) {
                    return collect($value)->recursive();
                }

                return $value;
            });
        });

        $this->app->singleton(SWApiService::class, function ($app) {
            return new SWApiService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
