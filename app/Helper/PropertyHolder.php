<?php

namespace App\Helper;

use App\Helper\Property;

trait PropertyHolder
{
    protected $properties;

    public function __construct(array $properties = [])
    {
        $this->properties = $properties;
    }

    public function __get($attribute)
    {
        $value = $this->properties[$attribute];
        return ($value instanceof Property ? $value->get() : $value);
    }

    public function __set($attribute, $value)
    {
        $this->properties[$attribute] = $value;
    }

    public function __isset($attribute)
    {
        return isset($this->properties[$attribute]);
    }

    public function __unset($attribute)
    {
        unset($this->properties[$attribute]);
    }

    public function __toString()
    {
        return \json_encode($this->properties);
    }
}