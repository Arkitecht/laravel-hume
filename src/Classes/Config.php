<?php

namespace Arkitecht\LaravelHume\Classes;

use Arkitecht\LaravelHume\Traits\ExtractsPropertiesFromJson;

class Config extends AbstractClass
{
    protected $casts = [
        'createdOn'  => 'datetime',
        'modifiedOn' => 'datetime',
    ];
    protected string $id;
    protected int $version = 0;

    protected string $eviVersion;

    protected string $versionDescription;

    protected string $name;

    protected int $createdOn;
    protected int $modifiedOn;

    protected Prompt $prompt;
    protected Voice $voice;

    protected ?LanguageModel $languageModel = null;

    protected ?EllmModel $ellmModel = null;

    protected array $tools;

    protected array $builtinTools;

    protected ?EventMessages $eventMessages = null;

    protected Timeout $timeouts;

    protected ?array $webhooks;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Config
    {
        $this->id = $id;

        return $this;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): Config
    {
        $this->version = $version;

        return $this;
    }

    public function getEviVersion(): string
    {
        return $this->eviVersion;
    }

    public function setEviVersion(string $eviVersion): Config
    {
        $this->eviVersion = $eviVersion;

        return $this;
    }

    public function getVersionDescription(): string
    {
        return $this->versionDescription ?? "";
    }

    public function setVersionDescription(string $versionDescription): Config
    {
        $this->versionDescription = $versionDescription;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Config
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedOn(): int
    {
        return $this->createdOn;
    }

    public function setCreatedOn(int $createdOn): Config
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getModifiedOn(): int
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(int $modifiedOn): Config
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getPrompt(): Prompt
    {
        return $this->prompt;
    }

    public function setPrompt(Prompt $prompt): Config
    {
        $this->prompt = $prompt;

        return $this;
    }

    public function getVoice(): Voice
    {
        return $this->voice;
    }

    public function setVoice(Voice $voice): Config
    {
        $this->voice = $voice;

        return $this;
    }

    public function getLanguageModel(): ?LanguageModel
    {
        return $this->languageModel;
    }

    public function setLanguageModel(LanguageModel $languageModel): Config
    {
        $this->languageModel = $languageModel;

        return $this;
    }

    public function getEllmModel(): ?EllmModel
    {
        return $this->ellmModel;
    }

    public function setEllmModel(EllmModel $ellmModel): Config
    {
        $this->ellmModel = $ellmModel;

        return $this;
    }

    public function getTools(): array
    {
        return $this->tools;
    }

    public function setTools(array $tools): Config
    {
        $this->tools = $tools;

        return $this;
    }

    public function getBuiltinTools(): array
    {
        return $this->builtinTools;
    }

    public function setBuiltinTools(array $builtinTools): Config
    {
        $this->builtinTools = $builtinTools;

        return $this;
    }

    public function getEventMessages(): ?EventMessages
    {
        return $this->eventMessages;
    }

    public function setEventMessages(EventMessages $eventMessages): Config
    {
        $this->eventMessages = $eventMessages;

        return $this;
    }

    public function getTimeouts(): Timeout
    {
        return $this->timeouts;
    }

    public function setTimeouts(Timeout $timeouts): Config
    {
        $this->timeouts = $timeouts;

        return $this;
    }

    public function getWebhooks(): ?array
    {
        return $this->webhooks;
    }

    public function setWebhooks(?array $webhooks): Config
    {
        $this->webhooks = $webhooks;

        return $this;
    }

}
