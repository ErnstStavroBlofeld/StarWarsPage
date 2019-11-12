<?php

namespace App\Service\StarWars;

use Iterator;
use App\Service\ApiModel;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class SWApiMultiModel implements ApiModel
{
    private $iterator;

    public function __construct(string $category)
    {
        $this->iterator = new SWApiMultiModelPageIterator($category);
    }

    public function getIterator()
    {
        return $this->iterator;
    }

    public function parse(Collection $data): Collection
    {
        $this->iterator->hasNext = $data->get('next') != '';

        return $data
            ->get('results')
            ->mapWithKeys(function ($value, $key) {
                return [Str::camel($key) => $value];
            });
    }

    public function build(Collection $data): Collection
    {
        return $data
            ->flatten(1)
            ->map(function ($collection) {
                $groups = Str::match('/\/(?<group>\w+)\/(?<id>\d+)\/?$/', $collection->get('url'));
                return (new SWApiMonoModel($groups['group'], $groups['id']))->build($collection);
            });
    }
}

class SWApiMultiModelPageIterator implements Iterator
{
    private $category;
    
    private $page;

    public $hasNext;

    public function __construct(string $category)
    {
        $this->category = $category;
        $this->page = 1;
        $this->hasNext = true;
    }

    public function current()
    {
        return $this->category . '/?page=' . $this->page;
    }

    public function key()
    {
        return $this->page - 1;
    }

    public function next()
    {
        $this->page++;
    }

    public function valid()
    {
        return $this->hasNext;
    }

    public function rewind()
    {
        $this->page = 1;
    }
}