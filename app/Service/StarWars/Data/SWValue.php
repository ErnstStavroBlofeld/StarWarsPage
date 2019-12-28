<?php


namespace App\Service\StarWars\Data;


use App\Exceptions\ParseException;
use App\Exceptions\ValidateException;

class SWValue
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function validate(callable $validator)
    {
        $validator($this->value);
        return $this;
    }

    public function notnull()
    {
        if (is_null($this->value)) {
            throw new ValidateException('Value is null');
        }

        return $this;
    }

    public function parse(callable $parser)
    {
        try {
            $this->value = $parser($this->value);
        } catch (\Throwable $throwable) {
            throw new ParseException($throwable);
        }

        return $this;
    }

    public function int()
    {
        $this->value = intval($this->value);
        return $this;
    }

    public function float()
    {
        $this->value = floatval($this->value);
        return $this;
    }

    public function get()
    {
        return $this->value;
    }

    public function getOrDefault($default)
    {
        return $this->value ?? $default;
    }
}
