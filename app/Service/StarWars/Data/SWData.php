<?php


namespace App\Service\StarWars\Data;

use App\Exceptions\MissingFieldException;

class SWData
{
    private $array;

    public function __construct(array $data)
    {
        $this->array = $data;
    }

    public function field(string $name)
    {
        if (!isset($this->array[$name])) {
            throw new MissingFieldException($name);
        }

        return new SWValue($this->array[$name]);
    }

    public function all()
    {
        return $this->array;
    }
}
