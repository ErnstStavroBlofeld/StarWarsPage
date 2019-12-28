<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\Data\SWData;
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

    public static function category()
    {
        return 'people';
    }

    public static function instantiate(int $id, SWData $data)
    {
        $instance = new SWPeople();

        $instance->id = $id;

        $instance->height = $data->field('height')
            ->notnull()
            ->int()
            ->get();

        $instance->mass = $data->field('mass')
            ->notnull()
            ->int()
            ->get();

        $instance->name = $data->field('name')
            ->notnull()
            ->get();

        $instance->hairColor = $data->field('hair_color')
            ->notnull()
            ->get();

        $instance->skinColor = $data->field('skin_color')
            ->notnull()
            ->get();

        $instance->eyeColor = $data->field('eye_color')
            ->notnull()
            ->get();

        $instance->birthYear = $data->field('birth_year')
            ->notnull()
            ->get();

        $instance->gender = $data->field('gender')
            ->notnull()
            ->get();

        $instance->homeworld = $data->field('homeworld')
            ->notnull()
            ->parse(SWHelper::getUrlIdCallable())
            ->get();

        $instance->films = $data->field('films')
            ->notnull()
            ->parse(SWHelper::getUrlIdsCallable())
            ->get();

        $instance->species = $data->field('species')
            ->notnull()
            ->parse(SWHelper::getUrlIdsCallable())
            ->get();

        $instance->vehicles = $data->field('vehicles')
            ->notnull()
            ->parse(SWHelper::getUrlIdsCallable())
            ->get();

        $instance->starships = $data->field('starships')
            ->notnull()
            ->parse(SWHelper::getUrlIdsCallable())
            ->get();

        $instance->created = $data->field('created')
            ->parse(function ($value) {
                return new DateTime($value);
            })->get();

        $instance->edited = $data->field('edited')
            ->parse(function ($value) {
                return new DateTime($value);
            })->get();

        return $instance;
    }

    public function getApiProperties()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'height' => $this->height,
            'mass' => $this->mass,
            'hair_color' => $this->hairColor,
            'skin_color' => $this->skinColor,
            'eye_color' => $this->eyeColor,
            'birth_year' => $this->birthYear,
            'gender' => $this->gender,
            'homeworld' => $this->homeworld,
            'films' => $this->films,
            'species' => $this->species,
            'vehicles' => $this->vehicles,
            'starships' => $this->starships,
            'created' => $this->created->format('Y-m-d H:i:s'),
            'last_edited' => $this->edited->format('Y-m-d H:i:s'),
        ];
    }
}
