<?php

namespace Arkitecht\LaravelHume\Responses;

use Carbon\Carbon;

class AccessTokenResponse extends AbstractResponse
{
    protected string $accessToken;
    protected string $tokenType;
    protected string $grantType;
    protected int $issuedAt;
    protected int $expiresIn;

    public function token(): string
    {
        return $this->accessToken;
    }

    public function tokenType(): string
    {
        return $this->tokenType;
    }

    public function grantType(): string
    {
        return $this->grantType;
    }

    public function issuedAt(bool $asCarbon = false): int|Carbon
    {
        return $asCarbon ? Carbon::parse($this->issuedAt) : $this->issuedAt;
    }

    public function expiresIn(): int
    {
        return $this->expiresIn;
    }

    public function expiresAt(): Carbon
    {
        return $this->issuedAt(true)->addSeconds($this->expiresIn());
    }
}
