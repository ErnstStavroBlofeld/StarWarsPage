<?php

namespace App\Service\StarWars;

use App\Service\ApiResolver;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use App\Exceptions\ApiConnectionException;
use App\Exceptions\ApiResponseException;
use App\Service\ApiModel;

class SWApiResolver implements ApiResolver
{
    private $client;

    private $model;

    public function __construct(Client $client, ApiModel $model)
    {
        $this->client = $client;
        $this->model = $model;
    }

    public function __toString()
    {
        return $this->model->getInternalUrl();
    }

    private function raw(string $url): string
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

    public function resolve()
    {
        $data = collect();

        foreach ($this->model as $index => $url) {
            $parsed = $this->model->parse(collect(\json_decode($this->raw($url), true))->recursive());
            $data->put($index, $parsed);
        }

        $data = ($data->count() == 1) ? $data->first() : $data;
        return $this->model->build($data);
    }
}
