<?php

namespace App\Service\StarWars;

use Illuminate\Support\Str;
use App\Exceptions\MissingFieldException;

class SWHelper
{
    public static function CreateLinkElement(int $id, string $category)
    {
        return view('templates.entity-card-link', [
            'id' => $id,
            'category' => $category
        ]);
    }

    public static function CreateMultipleLinkElements(array $value, string $category)
    {
        return \implode(' ', \array_map(function (int $id) use ($category) {
            return static::CreateLinkElement($id, $category);
        }, $value));
    }

    public static function ExtractObjectId(string $url)
    {
        return (int) Str::match('/\/(\d+)\/?$/', \parse_url($url, PHP_URL_PATH))[1];
    }

    public static function ExtractMultipleObjectIds(array $urls)
    {
        return \array_map(function (string $url) {
            return static::ExtractObjectId($url);
        }, $urls);
    }

    public static function ValidateData(array $data, array $fields)
    {
        foreach ($fields as $field) {
            if (!isset($data[$field])) {
                throw new MissingFieldException($field);
            }
        }
    }
}
