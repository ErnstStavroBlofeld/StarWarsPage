<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\Data\SWData;
use App\Service\StarWars\SWEntity;
use App\Service\StarWars\SWHelper;
use DateTime;

class SWStarships extends SWEntity
{
    public $id, $costInCredits, $length, $maxAtmospheringSpeed, $crew, $passengers,
        $cargoCapacity, $hyperdriveRating, $MGLT;

    public $name, $model, $manufacturer, $consumables, $starshipClass;

    public $pilots, $films;

    public $created, $edited;

    public static function category()
    {
        return 'starships';
    }

    public static function instantiate(int $id, SWData $data)
    {
        $instance = new SWStarships();

        $instance->id = $id;

        $instance->name = $data->field('name')
            ->notnull()
            ->get();

        $instance->model = $data->field('model')
            ->notnull()
            ->get();

        $instance->manufacturer = $data->field('manufacturer')
            ->notnull()
            ->get();

        $instance->costInCredits = $data->field('cost_in_credits')
            ->notnull()
            ->int()
            ->get();

        $instance->length = $data->field('length')
            ->notnull()
            ->float()
            ->get();

        $instance->maxAtmospheringSpeed = $data->field('max_atmosphering_speed')
            ->notnull()
            ->int()
            ->get();

        $instance->crew = $data->field('crew')
            ->notnull()
            ->int()
            ->get();

        $instance->passengers = $data->field('passengers')
            ->notnull()
            ->int()
            ->get();

        $instance->cargoCapacity = $data->field('cargo_capacity')
            ->notnull()
            ->int()
            ->get();

        $instance->consumables = $data->field('consumables')
            ->notnull()
            ->int()
            ->get();

        $instance->hyperdriveRating = $data->field('hyperdrive_rating')
            ->notnull()
            ->int()
            ->get();

        $instance->MGLT = $data->field('MGLT')
            ->notnull()
            ->int()
            ->get();

        $instance->starshipClass = $data->field('starship_class')
            ->notnull()
            ->get();

        $instance->pilots = $data->field('pilots')
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
            'model' => $this->model,
            'manufacturer' => $this->manufacturer,
            'cost_in_credits' => $this->costInCredits,
            'length' => $this->length,
            'maximum_atmosphering_speed' => $this->maxAtmospheringSpeed,
            'crew' => $this->crew,
            'passengers' => $this->passengers,
            'cargo_capacity' => $this->cargoCapacity,
            'consumables' => $this->consumables,
            'hyperdrive_rating' => $this->hyperdriveRating,
            'MGLT' => $this->MGLT,
            'class' => $this->starshipClass,
            'pilots' => $this->pilots,
            'films' => $this->films,
            'created' => $this->created->format('Y-m-d H:i:s'),
            'last_edited' => $this->edited->format('Y-m-d H:i:s'),
        ];
    }
}
