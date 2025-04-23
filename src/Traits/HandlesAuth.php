<?php

namespace Arkitecht\LaravelHume\Traits;

use Illuminate\Support\Facades\Http;
use Arkitecht\LaravelHume\Responses\AccessTokenResponse;

trait HandlesAuth
{
    protected AccessTokenResponse $accessToken;
    protected bool $useAccessToken = false;

    public function getAccessToken(): AccessTokenResponse
    {
        try {
            $response = Http::withBasicAuth($this->apiKey, $this->apiSecret)
                ->asForm()
                ->post('https://api.hume.ai/oauth2-cc/token', [
                    'grant_type' => 'client_credentials',
                ]);
        } catch (\Exception $exception) {

        }

        return AccessTokenResponse::fromJson($response->json()??[]);
    }

    public function usingAccessToken()
    {
        if (!isset($this->accessToken) || $this->accessToken->expiresAt()->lessThan(now())) {
            $this->setAccessToken($this->getAccessToken());
        }

        $this->useAccessToken = true;

        return $this;
    }

    public function setAccessToken(AccessTokenResponse $accessToken)
    {
        $this->accessToken = $accessToken;
    }


    public function usingApiCredentials()
    {
        $this->useAccessToken = false;

        return $this;
    }
}


