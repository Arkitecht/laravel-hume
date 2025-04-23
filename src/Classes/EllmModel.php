<?php

namespace Arkitecht\LaravelHume\Classes;

class EllmModel extends AbstractClass
{
    protected bool $allowShortResponses;

    public function getAllowShortResponses(): bool
    {
        return $this->allowShortResponses;
    }
    public function setAllowShortResponses(bool $allowShortResponses): EllmModel
    {
        $this->allowShortResponses = $allowShortResponses;
        return $this;
    }
}
