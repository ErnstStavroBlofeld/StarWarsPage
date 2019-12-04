<?php

namespace App\Service\StarWars\Entities;

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
        SWHelper::ValidateData($data, [
            'name',
            'classification',
            'designation',
            'average_height',
            'skin_colors',
            'hair_colors',
            'eye_colors',
            'average_lifespan',
            'people',
            'films',
            'created',
            'edited'
        ]);

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
        $instance->people          = SWHelper::ExtractMultipleObjectIds($data['people']);
        $instance->films           = SWHelper::ExtractMultipleObjectIds($data['films']);
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

    public function getArrayProperties()
    {
        return [
            'id'               => $this->id,
            'name'             => $this->name,
            'classification'   => $this->classification,
            'designation'      => $this->designation,
            'average_height'   => $this->averageHeight,
            'skin_colors'      => $this->skinColors,
            'hair_colors'      => $this->hairColors,
            'Eye_colors'       => $this->eyeColors,
            'average_lifespan' => $this->averageLifespan,
            'people'           => $this->people,
            'films'            => $this->films, 
            'created'          => $this->created->format('Y-m-d H:i:s'),
            'last_edited'      => $this->edited->format('Y-m-d H:i:s'),
        ];
    }
}
