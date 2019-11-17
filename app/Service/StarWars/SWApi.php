<?php

namespace App\Service\StarWars;

use GuzzleHttp\Client;
use App\Service\Api;
use App\Exceptions\ApiResponseException;
use App\Exceptions\ApiConnectionException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class SWApi implements Api
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

    public function urlObjectId(string $url)
    {
        return (int) Str::match('/\/(\d+)\/?$/', \parse_url($url, PHP_URL_PATH))[1];
    }

    public function get(string $url)
    {
        if (Cache::has($url)) {
            return Cache::get($url);
        }

        try {
            $response = $this->client->get($url);
        } catch (Exception $e) {
            throw new ApiConnectionException($url);
        }

        $code = $response->getStatusCode();
        $mime = $response->getHeader('content-type')[0] ?? 'text/plain';
        $json = Str::contains($mime, 'json');
        $content = $response->getBody()->getContents();

        if ($code < 400) {
            if ($json) {
                Cache::put($url, $content, env('SW_API_CACHE_TIME'));
                return $content;
            } else {
                throw new ApiResponseException($url, $code, $mime, $content);
            }
        } else {
            throw new ApiResponseException($url, $code, $mime, $content);
        }
    }

    public function getJson(string $url)
    {
        return \json_decode($this->get($url), true);
    }
}