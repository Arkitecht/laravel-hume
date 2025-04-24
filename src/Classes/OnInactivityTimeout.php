<?php

namespace Arkitecht\LaravelHume\Classes;

class OnInactivityTimeout extends AbstractClass
{
    protected bool $enabled;
    protected ?string $text = null;

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): OnInactivityTimeout
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): OnInactivityTimeout
    {
        $this->text = $text;
        return $this;
    }
}
