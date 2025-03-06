<?php

namespace Arkitecht\LaravelHume\Tests;

use Arkitecht\LaravelHume\Providers\HumeServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            HumeServiceProvider::class,
        ];
    }
}
