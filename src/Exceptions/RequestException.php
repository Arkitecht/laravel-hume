<?php

namespace Arkitecht\LaravelHume\Exceptions;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;
use Arkitecht\LaravelHume\Facades\Hume;

class RequestException extends \Exception
{
    protected Request $request;
    protected Response $response;

    public function __construct(protected ?array $json)
    {
        parent::__construct($json['message']);

        $this->request = Hume::getLastRequest();
        $this->response = Hume::getLastResponse();
    }

    public function getJson()
    {
        return $this->json;
    }

    public function getStatus(): int
    {
        return $this->json['status'];
    }

    public function getPath(): string
    {
        return $this->json['path'];
    }

    public function getError()
    {
        return $this->json['error'];
    }

    public function getTimestamp()
    {
        return $this->json['timestamp'];
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
