<?php


namespace App\Exceptions;


class ValidateException extends \Exception
{
    public function __construct(string $message = 'Validation failed', \Throwable $previous = null)
    {
        parent::__construct($message, $previous);
    }
}
