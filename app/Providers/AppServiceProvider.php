<?php

namespace App\Providers;

use App\Service\StarWars\SWApi;
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

        Str::macro('matches', function (string $regex, string $text) {
            return \preg_match($regex, $text, $parts);
        });

        $this->app->singleton(SWApi::class, function ($app) {
            return new SWApi();
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
