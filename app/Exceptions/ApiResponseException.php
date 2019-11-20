<?php

namespace App\Exceptions;

use App\Exceptions\ApiException;

class ApiResponseException extends ApiException
{
    public $code;
    
    public $mime;

    public $content;

    public function __construct(string $url, int $code, string $mime, string $content)
    {
        $this->code = $code;
        $this->mime = $mime;
        $this->content = $content;
        $this->url = $url;
        parent::__construct($url, 'Server returned status ' . $this->code . ' for request [' . $this->url . ']');
    }
}
