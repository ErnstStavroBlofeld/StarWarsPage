<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\SWApi;
use App\Service\StarWars\SWEntity;
use App\Service\StarWars\SWHelper;
use DateTime;

class SWPlanets extends SWEntity
{
    public $id, $rotationPeriod, $orbitalPeriod, $diameter, $surfaceWater, $population;

    public $name, $climate, $gravity, $terrain;

    public $residents, $films;

    public $created, $edited;

    protected static function make(int $id, array $data)
    {
        $api = resolve(SWApi::class);
        $instance = new SWPlanets();

        $instance->id             = $id;
        $instance->name           = $data['name'];
        $instance->rotationPeriod = (int) $data['rotation_period'];
        $instance->orbitalPeriod  = (int) $data['orbital_period'];
        $instance->diameter       = (int) $data['diameter'];
        $instance->climate        = $data['climate'];
        $instance->gravity        = $data['gravity'];
        $instance->terrain        = $data['terrain'];
        $instance->surfaceWater   = (int) $data['surface_water'];
        $instance->population     = (int) $data['population'];
        $instance->residents      = \array_map([$api, 'urlObjectId'], $data['residents']);
        $instance->films          = \array_map([$api, 'urlObjectId'], $data['films']);
        $instance->created        = new DateTime($data['created']);
        $instance->edited         = new DateTime($data['edited']);

        return $instance;
    }

    public function getTitle()
    {
        return $this->name;
    }

    public function getDisplayProperties()
    {
        return [
            'Rotation period' => $this->rotationPeriod,
            'Orbital period'  => $this->orbitalPeriod,
            'Diameter'        => $this->diameter,
            'Climate'         => $this->climate,
            'Gravity'         => $this->gravity,
            'Terrain'         => $this->terrain,
            'Surface water'   => $this->surfaceWater,
            'Population'      => $this->population,
            'Residents'       => SWHelper::CreateMultipleLinkElements($this->residents, 'people'),
            'Films'           => SWHelper::CreateMultipleLinkElements($this->films, 'films'),
            'Created'         => $this->created->format('Y-m-d H:i:s'),
            'Last edited'     => $this->edited->format('Y-m-d H:i:s'),
        ];
    }
}
