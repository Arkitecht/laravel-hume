<?php

namespace Arkitecht\LaravelHume\Responses;

use Illuminate\Support\Collection;
use Arkitecht\LaravelHume\Classes\Prompt;
use Arkitecht\LaravelHume\Traits\HasPagination;

class PromptListResponse extends AbstractResponse
{
    use HasPagination;

    protected array|Collection $promptsPage;

    public function getPromptsPage(): array|Collection
    {
        return $this->promptsPage;
    }

    public function setPromptsPage(array $promptsPage): PromptListResponse
    {
        $this->promptsPage = $promptsPage;

        return $this;
    }

    public function __call(string $function, array $arguments)
    {
        return collect($this->promptsPage)->$function(...$arguments);
    }

    public function afterExtraction()
    {
        if (isset($this->promptsPage)) {
            $this->promptsPage = collect($this->promptsPage)->map(fn($config) => Prompt::fromJson($config));
        } else {
            $this->promptsPage = collect();
        }
    }
}
