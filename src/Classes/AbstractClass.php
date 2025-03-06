<?php

namespace Arkitecht\LaravelHume\Classes;

use Arkitecht\LaravelHume\Traits\ExtractsPropertiesFromJson;
use Illuminate\Contracts\Support\Arrayable;

abstract class AbstractClass implements Arrayable
{
    use ExtractsPropertiesFromJson;
}
