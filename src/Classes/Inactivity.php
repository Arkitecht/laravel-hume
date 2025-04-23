<?php
namespace Arkitecht\LaravelHume\Classes;

class Inactivity extends AbstractClass
{
    protected bool $enabled;

    protected ?int $durationSecs = null;

    public function getDurationSecs(): ?int
    {
        return $this->durationSecs;
    }

    public function setDurationSecs(?int $durationSecs): Inactivity
    {
        $this->durationSecs = $durationSecs;
        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): Inactivity
    {
        $this->enabled = $enabled;
        return $this;
    }


}
