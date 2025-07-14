<?php

namespace Arkitecht\LaravelHume\Classes;

class Voice extends AbstractClass
{
    protected ?string $id;
    protected ?string $type;
    protected string $provider;
    protected string $name;
    protected ?array $customVoice;

    public function getName(): ?string
    {
        return $this->name ?? null;
    }

    public function setName(string $name): Voice
    {
        $this->name = $name;

        return $this;
    }

    public function getCustomVoice(): ?array
    {
        return $this->customVoice;
    }

    public function setCustomVoice(?array $customVoice): Voice
    {
        $this->customVoice = $customVoice;
        return $this;
    }

    public function getProvider(): string
    {
        return $this->provider;
    }

    public function setProvider(string $provider): Voice
    {
        $this->provider = $provider;
        return $this;
    }
}
