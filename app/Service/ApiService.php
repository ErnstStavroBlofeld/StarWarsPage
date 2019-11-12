<?php

namespace App\Service;

use App\Service\ApiModel;
use App\Service\ApiResolver;

interface ApiService
{
    public function prepare(ApiModel $model): ApiResolver;

    public function resolve(ApiModel $model);
}