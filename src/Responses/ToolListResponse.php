<?php

namespace Arkitecht\LaravelHume\Responses;


use Arkitecht\LaravelHume\Classes\Tool;
use Arkitecht\LaravelHume\Traits\HasPagination;
use Illuminate\Support\Collection;

class ToolListResponse extends AbstractResponse
{
    use HasPagination;

    protected array|Collection $toolsPage;

    public function getToolsPage(): array|Collection
    {
        return $this->toolsPage;
    }

    public function setToolsPage(array $toolsPage): ToolListResponse
    {
        $this->toolsPage = $toolsPage;

        return $this;
    }

    public function __call(string $function, array $arguments)
    {
        return collect($this->toolsPage)->$function(...$arguments);
    }

    public function afterExtraction()
    {
        if ( isset($this->toolsPage) ) {
            $this->toolsPage = collect($this->toolsPage)->map(fn($config) => Tool::fromJson($config));
        } else {
            $this->toolsPage = collect();
        }
    }
}
