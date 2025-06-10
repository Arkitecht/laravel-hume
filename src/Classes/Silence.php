<?php
namespace Arkitecht\LaravelHume\Classes;

class Silence extends AbstractClass
{
    protected bool $enabled;

    protected ?int $durationSecs = null;

    public function getDurationSecs(): ?int
    {
        return $this->durationSecs;
    }

    public function setDurationSecs(?int $durationSecs): Silence
    {
        $this->durationSecs = $durationSecs;
        return $this;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): Silence
    {
        $this->enabled = $enabled;
        return $this;
    }


}
