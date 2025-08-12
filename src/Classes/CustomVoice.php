<?php

namespace Arkitecht\LaravelHume\Classes;

use Arkitecht\LaravelHume\Enums\BaseVoice;

class CustomVoice extends AbstractClass
{
    protected array $_excludes = ['speechRateMultiplier', 'createdOn', 'modifiedOn', 'version', 'id'];
    protected string $id;
    protected int $version;
    protected string $name;
    protected int $createdOn;
    protected int $modifiedOn;
    protected BaseVoice $baseVoice;
    protected string $parameterModel = '20241004-11parameter';
    protected ?CustomVoiceParameters $parameters;
    protected int $speechRateMultiplier;
    protected string $provider = 'CUSTOM_VOICE';
    protected ?array $tags = [];

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): CustomVoice
    {
        $this->id = $id;

        return $this;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): CustomVoice
    {
        $this->version = $version;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CustomVoice
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedOn(): int
    {
        return $this->createdOn;
    }

    public function setCreatedOn(int $createdOn): CustomVoice
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getModifiedOn(): int
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(int $modifiedOn): CustomVoice
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getBaseVoice(): BaseVoice
    {
        return $this->baseVoice;
    }

    public function setBaseVoice(BaseVoice $baseVoice): CustomVoice
    {
        $this->baseVoice = $baseVoice;

        return $this;
    }

    public function getParameterModel(): string
    {
        return $this->parameterModel;
    }

    public function setParameterModel(string $parameterModel): CustomVoice
    {
        $this->parameterModel = $parameterModel;

        return $this;
    }

    public function getParameters(): ?CustomVoiceParameters
    {
        return $this->parameters;
    }

    public function setParameters(?CustomVoiceParameters $parameters): CustomVoice
    {
        $this->parameters = $parameters;

        return $this;
    }

    public function getSpeechRateMultiplier(): int
    {
        return $this->speechRateMultiplier;
    }

    public function setSpeechRateMultiplier(int $speechRateMultiplier): CustomVoice
    {
        $this->speechRateMultiplier = $speechRateMultiplier;

        return $this;
    }

    public function getTags(): array
    {
        return $this->tags;
    }

    public function setTags(array $tags): CustomVoice
    {
        $this->tags = $tags;

        return $this;
    }
}
