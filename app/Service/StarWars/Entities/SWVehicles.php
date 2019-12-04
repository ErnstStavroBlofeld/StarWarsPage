<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\SWEntity;
use App\Service\StarWars\SWHelper;
use DateTime;

class SWVehicles extends SWEntity
{
    public $id, $constInCredits, $length, $maxAtmospheringSpeed, $crew, $passengers, $cargoCapacity;

    public $name, $model, $manufacturer, $consumables, $vehicleClass;

    public $pilots, $films;

    public $created, $edited;

    protected static function make(int $id, array $data)
    {
        SWHelper::ValidateData($data, [
            'name',
            'model',
            'manufacturer',
            'cost_in_credits',
            'length',
            'max_atmosphering_speed',
            'crew',
            'passengers',
            'cargo_capacity',
            'consumables',
            'vehicle_class',
            'pilots',
            'films',
            'created',
            'edited'
        ]);

        $instance = new SWVehicles();

        $instance->id                   = $id;
        $instance->name                 = $data['name'];
        $instance->model                = $data['model'];
        $instance->manufacturer         = $data['manufacturer'];
        $instance->constInCredits       = (int) $data['cost_in_credits'];
        $instance->length               = (float) $data['length'];
        $instance->maxAtmospheringSpeed = (int) $data['max_atmosphering_speed'];
        $instance->crew                 = (int) $data['crew'];
        $instance->passengers           = (int) $data['passengers'];
        $instance->cargoCapacity        = (int) $data['cargo_capacity'];
        $instance->consumables          = $data['consumables'];
        $instance->vehicleClass         = $data['vehicle_class'];
        $instance->pilots               = SWHelper::ExtractMultipleObjectIds($data['pilots']);
        $instance->films                = SWHelper::ExtractMultipleObjectIds($data['films']);
        $instance->created              = new DateTime($data['created']);
        $instance->edited               = new DateTime($data['edited']);

        return $instance;
    }

    public function getTitle()
    {
        return $this->name;
    }

    public function getDisplayProperties()
    {
        return [
            'Model'                      => $this->model,
            'Manufacturer'               => $this->manufacturer,
            'Cost (in credits)'          => $this->constInCredits,
            'Length'                     => $this->length,
            'Maximum atmosphering speed' => $this->maxAtmospheringSpeed,
            'Crew'                       => $this->crew,
            'Passengers'                 => $this->passengers,
            'Cargo capacity'             => $this->cargoCapacity,
            'Consumables'                => $this->consumables,
            'Class'                      => $this->vehicleClass,
            'Pilots'                     => SWHelper::CreateMultipleLinkElements($this->pilots, 'people'),
            'Films'                      => SWHelper::CreateMultipleLinkElements($this->films, 'films'),
            'Created'                    => $this->created->format('Y-m-d H:i:s'),
            'Last edited'                => $this->edited->format('Y-m-d H:i:s'),
        ];
    }

    public function getArrayProperties()
    {
        return [
            'id'                         => $this->id,
            'name'                       => $this->name,
            'model'                      => $this->model,
            'manufacturer'               => $this->manufacturer,
            'cost_in_credits'            => $this->constInCredits,
            'length'                     => $this->length,
            'maximum_atmosphering_speed' => $this->maxAtmospheringSpeed,
            'crew'                       => $this->crew,
            'passengers'                 => $this->passengers,
            'cargo_capacity'             => $this->cargoCapacity,
            'consumables'                => $this->consumables,
            'class'                      => $this->vehicleClass,
            'pilots'                     => $this->pilots,
            'films'                      => $this->films,
            'created'                    => $this->created->format('Y-m-d H:i:s'),
            'last_edited'                => $this->edited->format('Y-m-d H:i:s'),
        ];
    }
}
