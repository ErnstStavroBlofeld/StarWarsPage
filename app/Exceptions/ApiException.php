<?php

namespace App\Exceptions;

use Exception;

class ApiException extends Exception
{
    public $apiUrl;

    public function __construct(string $apiUrl, string $message)
    {
        $this->apiUrl = $apiUrl;
        parent::__construct($message);
    }
}