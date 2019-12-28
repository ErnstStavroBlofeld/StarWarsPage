<?php

namespace App\Exceptions;

use Exception;

class MissingFieldException extends Exception
{
    public $field;

    public function __construct(string $field, string $message = null, \Throwable $previous = null)
    {
        $this->field = $field;
        parent::__construct($message ?? 'Field [' . $field . '] was not present in data', $previous);
    }
}
