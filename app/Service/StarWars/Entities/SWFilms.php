<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\SWEntity;
use App\Service\StarWars\SWHelper;
use DateTime;

class SWFilms extends SWEntity
{
    public $id, $episodeId;

    public $title, $openingCrawl, $director, $producer, $releaseDate;

    public $characters, $planets, $starships, $vehicles, $species;

    public $created, $edited;

    protected static function make(int $id, array $data)
    {
        SWHelper::ValidateData($data, [ 
            'title', 
            'episode_id', 
            'opening_crawl', 
            'director', 
            'producer', 
            'release_date', 
            'characters', 
            'planets', 
            'starships', 
            'vehicles', 
            'species', 
            'created', 
            'edited' 
        ]);
        
        $instance = new SWFilms();

        $instance->id           = $id;
        $instance->title        = $data['title'];
        $instance->episodeId    = (int) $data['episode_id'];
        $instance->openingCrawl = $data['opening_crawl'];
        $instance->director     = $data['director'];
        $instance->producer     = $data['producer'];
        $instance->releaseDate  = $data['release_date'];
        $instance->characters   = SWHelper::ExtractMultipleObjectIds($data['characters']);
        $instance->planets      = SWHelper::ExtractMultipleObjectIds($data['planets']);
        $instance->starships    = SWHelper::ExtractMultipleObjectIds($data['starships']);
        $instance->vehicles     = SWHelper::ExtractMultipleObjectIds($data['vehicles']);
        $instance->species      = SWHelper::ExtractMultipleObjectIds($data['species']);
        $instance->created      = new DateTime($data['created']);
        $instance->edited       = new DateTime($data['edited']);

        return $instance;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDisplayProperties()
    {
        return [
            'Episode'       => $this->episodeId,
            'Opening crawl' => $this->openingCrawl,
            'Director'      => $this->director,
            'Producer'      => $this->producer,
            'Release date'  => $this->releaseDate,
            'Characters'    => SWHelper::CreateMultipleLinkElements($this->characters, 'people'),
            'Planets'       => SWHelper::CreateMultipleLinkElements($this->planets, 'planets'),
            'Starships'     => SWHelper::CreateMultipleLinkElements($this->starships, 'starships'),
            'Vehicles'      => SWHelper::CreateMultipleLinkElements($this->vehicles, 'vehicles'),
            'Species'       => SWHelper::CreateMultipleLinkElements($this->species, 'species'),
            'Created'       => $this->created->format('Y-m-d H:i:s'),
            'Last edited'   => $this->edited->format('Y-m-d H:i:s'),
        ];
    }

    public function getArrayProperties()
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'episode'       => $this->episodeId,
            'opening_crawl' => $this->openingCrawl,
            'director'      => $this->director,
            'producer'      => $this->producer,
            'release_date'  => $this->releaseDate,
            'characters'    => $this->characters,
            'planets'       => $this->planets,
            'starships'     => $this->starships, 
            'vehicles'      => $this->vehicles,
            'species'       => $this->species, 
            'created'       => $this->created->format('Y-m-d H:i:s'),
            'last_edited'   => $this->edited->format('Y-m-d H:i:s'),
        ];
    }
}
