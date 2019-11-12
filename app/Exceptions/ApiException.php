<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    public $apiUrl;

    public function __construct(string $apiUrl)
    {
        $this->apiUrl = $apiUrl;
    }
}