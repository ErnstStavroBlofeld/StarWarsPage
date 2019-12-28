<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\Data\SWData;
use App\Service\StarWars\SWEntity;
use App\Service\StarWars\SWHelper;
use DateTime;

class SWSpecies extends SWEntity
{
    public $id, $averageHeight, $averageLifespan;

    public $name, $classification, $designation, $skinColors, $hairColors, $eyeColors, $language;

    public $people, $films;

    public $created, $edited;

    public static function category()
    {
        return 'species';
    }

    public static function instantiate(int $id, SWData $data)
    {
        $instance = new SWSpecies();

        $instance->id = $id;

        $instance->name = $data->field('name')
            ->notnull()
            ->get();

        $instance->classification = $data->field('classification')
            ->notnull()
            ->get();

        $instance->designation = $data->field('designation')
            ->notnull()
            ->get();

        $instance->averageHeight = $data->field('average_height')
            ->notnull()
            ->int()
            ->get();

        $instance->hairColors = $data->field('hair_colors')
            ->notnull()
            ->get();

        $instance->skinColors = $data->field('skin_colors')
            ->notnull()
            ->get();

        $instance->eyeColors = $data->field('eye_colors')
            ->notnull()
            ->get();

        $instance->averageLifespan = $data->field('average_lifespan')
            ->notnull()
            ->get();

        $instance->language = $data->field('language')
            ->notnull()
            ->get();

        $instance->people = $data->field('people')
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
            'classification' => $this->classification,
            'designation' => $this->designation,
            'average_height' => $this->averageHeight,
            'skin_colors' => $this->skinColors,
            'hair_colors' => $this->hairColors,
            'eye_colors' => $this->eyeColors,
            'average_lifespan' => $this->averageLifespan,
            'people' => $this->people,
            'films' => $this->films,
            'created' => $this->created->format('Y-m-d H:i:s'),
            'last_edited' => $this->edited->format('Y-m-d H:i:s'),
        ];
    }
}
