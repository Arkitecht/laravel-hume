<?php

namespace Arkitecht\LaravelHume\Classes;

use Arkitecht\LaravelHume\Enums\ToolType;
use Arkitecht\LaravelHume\Enums\VersionType;
use Arkitecht\LaravelHume\Traits\HasPagination;
use Illuminate\Support\Collection;

class Tool extends AbstractClass
{
    use HasPagination;

    protected string $id;
    protected ToolType $toolType;
    protected int $version;
    protected VersionType $versionType;
    protected string $name;
    protected int $createdOn;
    protected int $modifiedOn;
    protected string $parameters;
    protected ?string $versionDescription;
    protected ?string $fallbackContent;
    protected ?string $description;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Tool
    {
        $this->id = $id;

        return $this;
    }

    public function getToolType(): ToolType
    {
        return $this->toolType;
    }

    public function setToolType(ToolType $toolType): Tool
    {
        $this->toolType = $toolType;

        return $this;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): Tool
    {
        $this->version = $version;

        return $this;
    }

    public function getVersionType(): VersionType
    {
        return $this->versionType;
    }

    public function setVersionType(VersionType $versionType): Tool
    {
        $this->versionType = $versionType;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Tool
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedOn(): int
    {
        return $this->createdOn;
    }

    public function setCreatedOn(int $createdOn): Tool
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getModifiedOn(): int
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(int $modifiedOn): Tool
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getParameters(): string
    {
        return $this->parameters;
    }

    public function setParameters(mixed $parameters): Tool
    {
        if (is_string($parameters)) {
            $this->parameters = $parameters;

            return $this;
        }

        $this->parameters = json_encode($parameters);

        return $this;
    }

    public function getVersionDescription(): ?string
    {
        return $this->versionDescription;
    }

    public function setVersionDescription(?string $versionDescription): Tool
    {
        $this->versionDescription = $versionDescription;

        return $this;
    }

    public function getFallbackContent(): ?string
    {
        return $this->fallbackContent;
    }

    public function setFallbackContent(?string $fallbackContent): Tool
    {
        $this->fallbackContent = $fallbackContent;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Tool
    {
        $this->description = $description;

        return $this;
    }
}
