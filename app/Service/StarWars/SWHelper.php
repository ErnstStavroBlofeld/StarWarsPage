<?php

namespace App\Service\StarWars;

use App\Helper\FunctionVariables;
use Illuminate\Support\Str;

class SWHelper
{
    use FunctionVariables;

    public static function getUrlId(string $url)
    {
        return (int)Str::match('/\/(\d+)\/?$/', \parse_url($url, PHP_URL_PATH))[1];
    }

    public static function getUrlIds(array $urls)
    {
        return \array_map(function (string $url) {
            return static::getUrlId($url);
        }, $urls);
    }
}
