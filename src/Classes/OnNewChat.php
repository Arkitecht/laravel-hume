<?php

namespace Arkitecht\LaravelHume\Classes;

class OnNewChat extends AbstractClass
{

    protected bool $enabled = false;
    protected ?string $text = null;

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): OnNewChat
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): OnNewChat
    {
        $this->text = $text;
        return $this;
    }
}
