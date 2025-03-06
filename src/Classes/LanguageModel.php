<?php

namespace Arkitecht\LaravelHume\Classes;

use Arkitecht\LaravelHume\Enums\ModelProvider;
use Arkitecht\LaravelHume\Enums\ModelResource;

class LanguageModel extends AbstractClass
{
    protected ModelProvider $modelProvider;
    protected ModelResource $modelResource;
    protected float $temperature;
}
