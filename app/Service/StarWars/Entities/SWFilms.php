<?php

namespace App\Service\StarWars\Entities;

use App\Service\StarWars\Data\SWData;
use App\Service\StarWars\SWEntity;
use App\Service\StarWars\SWHelper;
use DateTime;

class SWFilms extends SWEntity
{
    public $id, $episodeId;

    public $title, $openingCrawl, $director, $producer, $releaseDate;

    public $characters, $planets, $starships, $vehicles, $species;

    public $created, $edited;

    public static function category()
    {
        return 'films';
    }

    public static function instantiate(int $id, SWData $data)
    {
        $instance = new SWFilms();

        $instance->id = $id;

        $instance->title = $data->field('title')
            ->notnull()
            ->get();

        $instance->episodeId = $data->field('episode_id')
            ->notnull()
            ->int()
            ->get();

        $instance->openingCrawl = $data->field('opening_crawl')
            ->notnull()
            ->get();

        $instance->director = $data->field('director')
            ->notnull()
            ->get();

        $instance->producer = $data->field('producer')
            ->notnull()
            ->get();

        $instance->releaseDate = $data->field('release_date')
            ->notnull()
            ->get();

        $instance->characters = $data->field('characters')
            ->notnull()
            ->parse(SWHelper::getUrlIdsCallable())
            ->get();

        $instance->planets = $data->field('planets')
            ->notnull()
            ->parse(SWHelper::getUrlIdsCallable())
            ->get();

        $instance->starships = $data->field('starships')
            ->notnull()
            ->parse(SWHelper::getUrlIdsCallable())
            ->get();

        $instance->vehicles = $data->field('vehicles')
            ->notnull()
            ->parse(SWHelper::getUrlIdsCallable())
            ->get();

        $instance->species = $data->field('species')
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
            'title' => $this->title,
            'episode' => $this->episodeId,
            'opening_crawl' => $this->openingCrawl,
            'director' => $this->director,
            'producer' => $this->producer,
            'release_date' => $this->releaseDate,
            'characters' => $this->characters,
            'planets' => $this->planets,
            'starships' => $this->starships,
            'vehicles' => $this->vehicles,
            'species' => $this->species,
            'created' => $this->created->format('Y-m-d H:i:s'),
            'last_edited' => $this->edited->format('Y-m-d H:i:s'),
        ];
    }
}
