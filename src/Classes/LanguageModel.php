<?php

namespace Arkitecht\LaravelHume\Classes;

use Arkitecht\LaravelHume\Enums\ModelProvider;
use Arkitecht\LaravelHume\Enums\ModelResource;

class LanguageModel extends AbstractClass
{
    protected ?ModelProvider $modelProvider = null;
    protected ?string $modelResource = null;
    protected ?float $temperature = null;

    public function getModelProvider(): ?ModelProvider
    {
        return $this->modelProvider;
    }

    public function setModelProvider(ModelProvider $modelProvider)
    {
        $this->modelProvider = $modelProvider;
        return $this;
    }

    public function getModelResource(): ?string
    {
        return $this->modelResource;
    }

    public function setModelResource(string $modelResource)
    {
        $this->modelResource = $modelResource;
        return $this;
    }

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature)
    {
        $this->temperature = $temperature;
        return $this;
    }
}
