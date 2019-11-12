<?php

namespace App\Service\StarWars;

use GuzzleHttp\Client;
use App\Service\ApiModel;
use App\Service\ApiService;
use App\Service\ApiResolver;
use App\Service\StarWars\SWApiResolver;

class SWApiService implements ApiService
{
    private $client;
    
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('SW_API_URL');
        $this->client = new Client([
            'method' => 'GET',
            'base_uri' => $this->apiUrl,
            'headers' => [
                'accept' => 'application/json'
            ],
            'timeout' => 30,
            'exceptions' => false,
        ]);
    }

    public function prepare(ApiModel $model): ApiResolver
    {
        return new SWApiResolver($this->client, $model);
    }

    public function resolve(ApiModel $model)
    {
        return $this->prepare($model)->resolve();
    }
}