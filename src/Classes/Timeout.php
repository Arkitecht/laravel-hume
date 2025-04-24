<?php

namespace Arkitecht\LaravelHume\Classes;

class Timeout extends AbstractClass
{
    protected Inactivity $inactivity;
    protected MaxDuration $maxDuration;

    public function getInactivity(): Inactivity
    {
        return $this->inactivity;
    }

    public function setInactivity(Inactivity $inactivity): Timeout
    {
        $this->inactivity = $inactivity;
        return $this;
    }

    public function getMaxDuration(): MaxDuration
    {
        return $this->maxDuration;
    }

    public function setMaxDuration(MaxDuration $maxDuration): Timeout
    {
        $this->maxDuration = $maxDuration;
        return $this;
    }


}
