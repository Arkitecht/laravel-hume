<?php

namespace Arkitecht\LaravelHume\Classes;

class MaxDuration extends AbstractClass
{
    protected bool $enabled;

    protected ?int $durationSecs = null;

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): MaxDuration
    {
        $this->enabled = $enabled;
        return $this;
    }

    public function getDurationSecs(): ?int
    {
        return $this->durationSecs;
    }

    public function setDurationSecs(?int $durationSecs): MaxDuration
    {
        $this->durationSecs = $durationSecs;
        return $this;
    }


}
