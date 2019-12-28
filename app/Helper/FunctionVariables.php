<?php


namespace App\Helper;

use Illuminate\Support\Str;

trait FunctionVariables
{
    public static function __callStatic($name, $arguments)
    {
        if (Str::endsWith($name, 'Callable')) {
            return \Closure::fromCallable([get_called_class(), Str::substr($name, 0, Str::length($name) - 8)]);
        }

        return null;
    }
}
