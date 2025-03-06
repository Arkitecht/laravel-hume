<?php

namespace Arkitecht\LaravelHume\Responses;


use Arkitecht\LaravelHume\Classes\Config;
use Arkitecht\LaravelHume\Traits\HasPagination;
use Illuminate\Support\Collection;

class ConfigListResponse extends AbstractResponse
{
    use HasPagination;

    protected array|Collection $configsPage;

    public function getConfigsPage(): array|Collection
    {
        return $this->configsPage;
    }

    public function setConfigsPage(array $configsPage): ConfigListResponse
    {
        $this->configsPage = $configsPage;

        return $this;
    }

    public function __call(string $function, array $arguments)
    {
        return collect($this->configsPage)->$function(...$arguments);
    }

    public function afterExtraction()
    {
        $this->configsPage = $this->map(fn($config) => Config::fromJson($config));
    }
}
