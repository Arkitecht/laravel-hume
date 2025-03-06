<?php

namespace Arkitecht\LaravelHume\Providers;

use Arkitecht\LaravelHume\Hume;
use Illuminate\Support\ServiceProvider;

class HumeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/hume.php', 'hume');
        $this->app->singleton(Hume::class, function () {
            $hume = new Hume(config('hume.api_key'), config('hume.api_secret'));
            if (config('hume.authentication') == 'token') {
                $hume->usingAccessToken();
            }

            return $hume;
        });
        $this->app->alias(Hume::class, 'hume');

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../../config/hume.php' => config_path('hume.php'),
        ], 'hume');
    }
}
