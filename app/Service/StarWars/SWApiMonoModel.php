<?php

namespace App\Service\StarWars;

use DateTime;
use ArrayIterator;
use RuntimeException;
use App\Service\ApiModel;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class SWApiMonoModel implements ApiModel
{
    private $objectId;

    private $category;

    public $properties;

    public function __construct(string $category, int $objectId)
    {
        $this->category = $category;
        $this->objectId = $objectId;
        $this->properties = collect();
    }

    public function getIterator()
    {
        return new ArrayIterator([
            $this->category . '/' . $this->objectId
        ]);
    }

    public function __isset($key)
    {
        return $this->properties->has($key);
    }

    public function __set($key, $value)
    {
        $this->properties->put($key, $value);
    }

    public function __get($key)
    {
        if (!$this->__isset($key))
            throw new RuntimeException('Property ' . $key . ' does not exists!');

        $value = $this->properties->get($key);

        if ($value instanceof SWApiResolver) {
            $value = $value->resolve();
        } 
        
        if ($value instanceof Collection) {
            $value = $value->map(function ($value) {
                if ($value instanceof SWApiResolver) {
                    return $value->resolve();
                } else {
                    return $value;
                }
            });
        }

        $this->properties->put($key, $value);
        return $value;
    }

    public function __unset($key)
    {
        $this->properties->forget($key);
    }

    public function __toString()
    {
        return $this->properties->toJson();
    }

    public function getInternalUrl()
    {
        return \url($this->category . '/' . ($this->objectId ?? ''));
    }

    public function parse(Collection $data): Collection
    {
        return $data->mapWithKeys(function ($value, $key) {
            return [ Str::camel($key) => $value ];
        });
    }

    public function build(Collection $data): self
    {
        $prepareResolver = function(string $url) {
            $groups = Str::match('/\/(?<group>\w+)\/(?<id>\d+)\/?$/', $url);

            return \resolve(SWApiService::class)
                ->prepare(new SWApiMonoModel($groups['group'], (int) $groups['id']));
        };

        $parseDateTime = function (string $timestamp) {
            return new DateTime($timestamp);
        };

        $homeworld = $data->only(['homeworld'])->map($prepareResolver);

        $people = $data->only(['people', 'residents', 'characters', 'pilots'])->map->map($prepareResolver);
        $films = $data->only(['films'])->map->map($prepareResolver);
        $species = $data->only(['species'])->map->map($prepareResolver);
        $vehicles = $data->only(['vehicles'])->map->map($prepareResolver);
        $starships = $data->only(['starships'])->map->map($prepareResolver);
        
        $timestamps = $data->only(['created', 'edited', 'releaseDate'])->map($parseDateTime);

        $this->properties = $this->properties
            ->mergeRecursive($data)
            ->merge($people)
            ->merge($homeworld)
            ->merge($films)
            ->merge($species)
            ->merge($vehicles)
            ->merge($starships)
            ->merge($timestamps);

        $this->properties->forget('url');
        return $this;
    }
}