<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\SWApi;
use App\Service\StarWars\SWEntity;
use DateTime;

class SWFilms extends SWEntity
{
    public $id, $episodeId;

    public $title, $openingCrawl, $director, $producer, $releaseDate;

    public $characters, $planets, $starships, $vehicles, $species;

    public $created, $edited;

    protected static function make(int $id, array $data)
    {
        $api = resolve(SWApi::class);
        $instance = new SWFilms();

        $instance->id           = $id;
        $instance->title        = $data['title'];
        $instance->episodeId    = (int) $data['episode_id'];
        $instance->openingCrawl = $data['opening_crawl'];
        $instance->director     = $data['director'];
        $instance->producer     = $data['producer'];
        $instance->releaseDate  = $data['release_date'];
        $instance->characters   = \array_map([$api, 'urlObjectId'], $data['characters']);
        $instance->planets      = \array_map([$api, 'urlObjectId'], $data['planets']);
        $instance->starships    = \array_map([$api, 'urlObjectId'], $data['starships']);
        $instance->vehicles     = \array_map([$api, 'urlObjectId'], $data['vehicles']);
        $instance->species      = \array_map([$api, 'urlObjectId'], $data['species']);
        $instance->created      = new DateTime($data['created']);
        $instance->edited       = new DateTime($data['edited']);

        return $instance;
    }
}
