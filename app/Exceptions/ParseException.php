<?php


namespace App\Exceptions;


class ParseException extends \Exception
{
    public function __construct(\Throwable $previous = null)
    {
        parent::__construct('Error while parsing', $previous);
    }
}
