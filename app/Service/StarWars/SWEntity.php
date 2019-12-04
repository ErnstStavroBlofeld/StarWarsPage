<?php

namespace App\Service\StarWars;

use App\Service\StarWars\SWApi;
use App\Service\StarWars\SWHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use RuntimeException;

abstract class SWEntity
{
    public static function category()
    {
        $category = Str::lower(Arr::last(Str::split('\\', \get_called_class())));

        if (Str::is('sw*', $category)) {
            $category = Str::substr($category, 2);
        }

        if (!in_array($category, ['people', 'planets', 'films', 'species', 'vehicles', 'starships'])) {
            throw new RuntimeException('Class [' . \get_called_class() . '] cannot be used as entity category');
        }
        
        return $category;
    }

    public static function find(int $id)
    {
        return static::make($id, resolve(SWApi::class)->getJson(self::category() . '/' . $id));
    }

    public static function all()
    {
        $api = resolve(SWApi::class);
        $category = self::category();
        $entities = [];
        $page = [];

        do
        {
            $page = $api->getJson($page['next'] ?? ($category . '/'));
            
            foreach ($page['results'] as $data) {
                \array_push($entities, static::make(
                    SWHelper::ExtractObjectId($data['url']),
                    $data
                ));
            }
        } while (isset($page['next']) && $page['next'] != null);

        return $entities;
    }

    protected static abstract function make(int $id, array $data);

    public abstract function getTitle();

    public abstract function getDisplayProperties();

    public abstract function getArrayProperties();
}