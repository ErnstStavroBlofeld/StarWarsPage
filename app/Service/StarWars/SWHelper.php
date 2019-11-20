<?php

namespace App\Service\StarWars;

class SWHelper
{
    public static function CreateLinkElement(int $id, string $category)
    {
        return '<a data-identifier="'. $category . ':' . $id . 
            '" href="' . url('/' . $category . '/' . $id) . '">' . $category . ':' . $id . '</a>';
    }

    public static function CreateMultipleLinkElements(array $value, string $category)
    {
        return \implode(' ', \array_map(function (int $id) use ($category) {
            return self::CreateLinkElement($id, $category);
        }, $value));
    }
};