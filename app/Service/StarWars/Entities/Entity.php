<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\SWApiMonoModel;
use App\Service\StarWars\SWApiMultiModel;
use App\Service\StarWars\SWApiService;
use Illuminate\Support\Str;
use RuntimeException;

class Entity
{
    private static function type()
    {
        $parts = \explode('\\', \get_called_class());
        return Str::lower(\array_pop($parts));
    }

    public static function find(int $id, string $entityType = '')
    {
        $type = $entityType ?? self::type();
        if (!\in_array($type, ['people', 'vehicles', 'planets', 'starships', 'species', 'films'])) {
            throw new RuntimeException('Invalid entity type!');
        }

        return resolve(SWApiService::class)->resolve(new SWApiMonoModel($type, $id));
    }

    public static function all(string $entityType = '')
    {
        $type = $entityType ?? self::type();
        if (!\in_array($type, ['people', 'vehicles', 'planets', 'starships', 'species', 'films'])) {
            throw new RuntimeException('Invalid entity type!');
        }

        return resolve(SWApiService::class)->resolve(new SWApiMultiModel($type));
    }
}

