<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\SWApi;
use App\Service\StarWars\SWEntity;
use App\Service\StarWars\SWHelper;
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

    public function getTitle()
    {
        return $this->name;
    }

    public function getDisplayProperties()
    {
        return [
            'Classification'   => $this->classification,
            'Designation'      => $this->designation,
            'Average height'   => $this->averageHeight,
            'Skin colors'      => $this->skinColors,
            'Hair colors'      => $this->hairColors,
            'Eye colors'       => $this->eyeColors,
            'Average lifespan' => $this->averageLifespan,
            'People'           => SWHelper::CreateMultipleLinkElements($this->people, 'people'),
            'Films'            => SWHelper::CreateMultipleLinkElements($this->films, 'films'),
            'Created'          => $this->created->format('Y-m-d H:i:s'),
            'Last edited'      => $this->edited->format('Y-m-d H:i:s'),
        ];
    }
}