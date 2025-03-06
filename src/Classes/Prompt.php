<?php

namespace Arkitecht\LaravelHume\Classes;

use Arkitecht\LaravelHume\Enums\VersionType;

class Prompt extends AbstractClass
{
    protected string $id;
    protected int $version;
    protected VersionType $versionType;
    protected string $name;
    protected int $createdOn;
    protected int $modifiedOn;
    protected string $text;
    protected string $versionDescription;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Prompt
    {
        $this->id = $id;

        return $this;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): Prompt
    {
        $this->version = $version;

        return $this;
    }

    public function getVersionType(): VersionType
    {
        return $this->versionType;
    }

    public function setVersionType(VersionType $versionType): Prompt
    {
        $this->versionType = $versionType;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Prompt
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedOn(): int
    {
        return $this->createdOn;
    }

    public function setCreatedOn(int $createdOn): Prompt
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getModifiedOn(): int
    {
        return $this->modifiedOn;
    }

    public function setModifiedOn(int $modifiedOn): Prompt
    {
        $this->modifiedOn = $modifiedOn;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): Prompt
    {
        $this->text = $text;

        return $this;
    }

    public function getVersionDescription(): string
    {
        return $this->versionDescription;
    }

    public function setVersionDescription(string $versionDescription): Prompt
    {
        $this->versionDescription = $versionDescription;

        return $this;
    }
}
