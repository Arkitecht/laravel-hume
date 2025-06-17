<?php

namespace Arkitecht\LaravelHume\Classes;

class Nudges extends AbstractClass
{
    protected bool $enabled;

    protected ?int $intervalSecs = null;

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): Nudges
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function getIntervalSecs(): ?int
    {
        return $this->intervalSecs;
    }

    public function setIntervalSecs(?int $intervalSecs): Nudges
    {
        $this->intervalSecs = $intervalSecs;
        return $this;
    }
}
