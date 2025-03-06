<?php
namespace Arkitecht\LaravelHume\Classes;

class Inactivity extends AbstractClass
{
    protected bool $enabled;

    protected ?int $durationSecs;
}
