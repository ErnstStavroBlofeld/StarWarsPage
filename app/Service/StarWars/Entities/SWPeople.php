<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\SWEntity;
use App\Service\StarWars\SWHelper;
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
        SWHelper::ValidateData($data, [
            'name',
            'height',
            'mass',
            'hair_color',
            'skin_color',
            'eye_color',
            'birth_year',
            'gender',
            'homeworld',
            'films',
            'species',
            'vehicles',
            'starships',
            'created',
            'edited'
        ]);

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
        $instance->homeworld = SWHelper::ExtractObjectId($data['homeworld']);
        $instance->films     = SWHelper::ExtractMultipleObjectIds($data['films']);
        $instance->species   = SWHelper::ExtractMultipleObjectIds($data['species']);
        $instance->vehicles  = SWHelper::ExtractMultipleObjectIds($data['vehicles']);
        $instance->starships = SWHelper::ExtractMultipleObjectIds($data['starships']);
        $instance->created   = new DateTime($data['created']);
        $instance->edited    = new DateTime($data['edited']);

        return $instance;
    }

    public function getTitle()
    {
        return $this->name;
    }


    public function getDisplayProperties()
    {
        return [
            'Height'      => $this->height,
            'Mass'        => $this->mass,
            'Hair color'  => $this->hairColor,
            'Skin color'  => $this->skinColor,
            'Eye color'   => $this->eyeColor,
            'Birth year'  => $this->birthYear,
            'Gender'      => $this->gender,
            'Homeworld'   => SWHelper::CreateLinkElement($this->homeworld, 'planets'),
            'Films'       => SWHelper::CreateMultipleLinkElements($this->films, 'films'),
            'Species'     => SWHelper::CreateMultipleLinkElements($this->species, 'species'),
            'Vehicles'    => SWHelper::CreateMultipleLinkElements($this->vehicles, 'vehicles'),
            'Starships'   => SWHelper::CreateMultipleLinkElements($this->starships, 'starships'),
            'Created'     => $this->created->format('Y-m-d H:i:s'),
            'Last edited' => $this->edited->format('Y-m-d H:i:s'),
        ];
    }

    public function getArrayProperties()
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'height'      => $this->height,
            'mass'        => $this->mass,
            'hair_color'  => $this->hairColor,
            'skin_color'  => $this->skinColor,
            'eye_color'   => $this->eyeColor,
            'birth_year'  => $this->birthYear,
            'gender'      => $this->gender,
            'homeworld'   => $this->homeworld,
            'films'       => $this->films,
            'species'     => $this->species, 
            'vehicles'    => $this->vehicles,
            'starships'   => $this->starships,
            'created'     => $this->created->format('Y-m-d H:i:s'),
            'last_edited' => $this->edited->format('Y-m-d H:i:s'),
        ];
    }
}