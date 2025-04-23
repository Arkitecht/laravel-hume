<?php

namespace Arkitecht\LaravelHume\Classes;

class OnMaxDurationTimeout extends AbstractClass
{

    protected bool $enabled;
    protected ?string $text = null;

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): OnMaxDurationTimeout
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): OnMaxDurationTimeout
    {
        $this->text = $text;
        return $this;
    }
}
