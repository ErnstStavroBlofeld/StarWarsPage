<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\SWApi;
use App\Service\StarWars\SWEntity;
use DateTime;

class SWSpecies extends SWEntity
{
    public $id, $averageHeight, $averageLifespan;

    public $name, $classification, $designation, $skinColors, $hairColors, $eyeColors, $language;

    public $people, $films;

    public $created, $edited;

    protected static function make(int $id, array $data)
    {
        $api = resolve(SWApi::class);
        $instance = new SWSpecies();

        $instance->id              = $id;
        $instance->name            = $data['name'];
        $instance->classification  = $data['classification'];
        $instance->designation     = $data['designation'];
        $instance->averageHeight   = $data['average_height'];
        $instance->skinColors      = $data['skin_colors'];
        $instance->hairColors      = $data['hair_colors'];
        $instance->eyeColors       = $data['eye_colors'];
        $instance->averageLifespan = $data['average_lifespan'];
        $instance->language        = $data['language'];
        $instance->people          = \array_map([$api, 'urlObjectId'], $data['people']);
        $instance->films           = \array_map([$api, 'urlObjectId'], $data['films']);
        $instance->created         = new DateTime($data['created']);
        $instance->edited          = new DateTime($data['edited']);

        return $instance;
    }
}
