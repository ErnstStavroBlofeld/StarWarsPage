<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\Data\SWData;
use App\Service\StarWars\SWEntity;
use App\Service\StarWars\SWHelper;
use DateTime;

class SWPlanets extends SWEntity
{
    public $id, $rotationPeriod, $orbitalPeriod, $diameter, $surfaceWater, $population;

    public $name, $climate, $gravity, $terrain;

    public $residents, $films;

    public $created, $edited;

    public static function category()
    {
        return 'planets';
    }

    public static function instantiate(int $id, SWData $data)
    {
        $instance = new SWPlanets();

        $instance->id = $id;

        $instance->name = $data->field('name')
            ->notnull()
            ->get();

        $instance->rotationPeriod = $data->field('rotation_period')
            ->notnull()
            ->int()
            ->get();

        $instance->orbitalPeriod = $data->field('orbital_period')
            ->notnull()
            ->int()
            ->get();

        $instance->diameter = $data->field('diameter')
            ->notnull()
            ->int()
            ->get();

        $instance->climate = $data->field('climate')
            ->notnull()
            ->get();

        $instance->gravity = $data->field('gravity')
            ->notnull()
            ->get();

        $instance->terrain = $data->field('terrain')
            ->notnull()
            ->get();

        $instance->surfaceWater = $data->field('surface_water')
            ->notnull()
            ->int()
            ->get();

        $instance->population = $data->field('population')
            ->notnull()
            ->int()
            ->get();

        $instance->residents = $data->field('residents')
            ->notnull()
            ->parse(SWHelper::getUrlIdsCallable())
            ->get();

        $instance->residents = $data->field('residents')
            ->notnull()
            ->parse(SWHelper::getUrlIdsCallable())
            ->get();

        $instance->films = $data->field('films')
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
            'rotation_period' => $this->rotationPeriod,
            'orbital_period' => $this->orbitalPeriod,
            'diameter' => $this->diameter,
            'climate' => $this->climate,
            'gravity' => $this->gravity,
            'terrain' => $this->terrain,
            'surface_water' => $this->surfaceWater,
            'population' => $this->population,
            'residents' => $this->residents,
            'films' => $this->films,
            'created' => $this->created->format('Y-m-d H:i:s'),
            'last_edited' => $this->edited->format('Y-m-d H:i:s'),
        ];
    }
}
