<?php

namespace Arkitecht\LaravelHume;


use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Arkitecht\LaravelHume\Traits\HandlesAuth;
use Arkitecht\LaravelHume\Traits\ManagesChats;
use Arkitecht\LaravelHume\Traits\ManagesTools;
use Arkitecht\LaravelHume\Traits\ManagesConfigs;
use Arkitecht\LaravelHume\Traits\ManagesPrompts;
use Arkitecht\LaravelHume\Traits\ManagesChatGroups;
use Arkitecht\LaravelHume\Traits\ManagesCustomVoices;
use Arkitecht\LaravelHume\Exceptions\RequestException;

class Hume
{
    use HandlesAuth;
    use ManagesChats;
    use ManagesTools;
    use ManagesConfigs;
    use ManagesPrompts;
    use ManagesChatGroups;
    use ManagesCustomVoices;

    protected int $defaultPageSize = 25;

    private Request $_lastRequest;
    private Response $_lastResponse;

    public function __construct(private string $apiKey, private string $apiSecret)
    {
    }

    public function setDefaultPageSize(int $pageSize): self
    {
        $this->defaultPageSize = $pageSize;

        return $this;
    }

    public function getLastRequest(): Request
    {
        return $this->_lastRequest;
    }

    public function getLastResponse(): Response
    {
        return $this->_lastResponse;
    }

    protected function request(string $uri, string $method = 'get', array $parameters = []): Response
    {
        $pendingRequest = null;

        if (!$this->useAccessToken) {
            $pendingRequest = Http::withHeader('X-Hume-Api-Key', $this->apiKey);
        }

        if ($this->useAccessToken) {
            $pendingRequest = Http::withToken($this->accessToken->token());
        }

        $pendingRequest->beforeSending(function ($request) {
            $this->_lastRequest = $request;
        });

        $response = $pendingRequest->{$method}($uri, $parameters);

        $this->_lastResponse = $response;

        $json = $response->json();

        if ((isset($json['error']) && $json['error'])) {
            throw new RequestException($json);
        }

        return $response;
    }

    private function getPaginationFromParameters(array &$parameters)
    {
        return $parameters = array_merge([
            'page_number' => 0,
            'page_size'   => $this->defaultPageSize,
        ], $parameters);
    }
}
