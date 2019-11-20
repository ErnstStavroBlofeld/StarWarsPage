<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\SWApi;
use App\Service\StarWars\SWEntity;
use DateTime;

class SWPeople extends SWEntity
{
    public $id, $height, $mass;

    public $name, $hairColor, $skinColor, $eyeColor, $birthYear, $gender;

    public $homeworld;

    public $films, $species, $vehicles, $starships;

    public $created, $edited;

    protected static function make(int $id, array $data)
    {
        $api = resolve(SWApi::class);
        $instance = new SWPeople();

        $instance->id        = $id;
        $instance->height    = (int) $data['height'];
        $instance->mass      = (int) $data['mass'];
        $instance->name      = $data['name'];
        $instance->hairColor = $data['hair_color'];
        $instance->skinColor = $data['skin_color'];
        $instance->eyeColor  = $data['eye_color'];
        $instance->birthYear = $data['birth_year'];
        $instance->gender    = $data['gender'];
        $instance->homeworld = $api->urlObjectId($data['homeworld']);
        $instance->films     = \array_map([$api, 'urlObjectId'], $data['films']);
        $instance->species   = \array_map([$api, 'urlObjectId'], $data['species']);
        $instance->vehicles  = \array_map([$api, 'urlObjectId'], $data['vehicles']);
        $instance->starships = \array_map([$api, 'urlObjectId'], $data['starships']);
        $instance->created   = new DateTime($data['created']);
        $instance->edited    = new DateTime($data['edited']);

        return $instance;
    }

    public function getTitle()
    {
        return $this->name;
    }
}