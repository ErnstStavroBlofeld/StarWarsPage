<?php

namespace App\Exceptions;

use App\Exceptions\ApiException;

class ApiConnectionException extends ApiException
{
    public function __construct(string $url)
    {
        parent::__construct($url, 'Cannot connect to [' . $url . ']');
    }
}