<?php

namespace App\Service;

use Illuminate\Support\Collection;
use IteratorAggregate;

interface ApiModel extends IteratorAggregate
{
    public function parse(Collection $data): Collection;

    public function build(Collection $data);
}