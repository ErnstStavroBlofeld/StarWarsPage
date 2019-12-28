<?php

namespace App\Service\StarWars;

use App\Service\StarWars\Data\SWData;

abstract class SWEntity
{
    public abstract function getApiProperties();

    public static abstract function category();

    public static abstract function instantiate(int $id, SWData $data);

    public static function find(int $id)
    {
        return static::instantiate($id, new SWData(resolve(SWApi::class)->getJson(static::category() . '/' . $id)));
    }

    public static function all()
    {
        $api = resolve(SWApi::class);
        $category = static::category();
        $entities = [];
        $page = [];

        do {
            $page = $api->getJson($page['next'] ?? ($category . '/'));

            foreach ($page['results'] as $data) {
                array_push($entities, static::instantiate(
                    SWHelper::getUrlId($data['url']),
                    new SWData($data)
                ));
            }
        } while (isset($page['next']) && $page['next'] != null);

        return $entities;
    }
}
