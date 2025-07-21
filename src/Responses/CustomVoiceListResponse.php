<?php

namespace Arkitecht\LaravelHume\Responses;

use Arkitecht\LaravelHume\Classes\CustomVoice;
use Illuminate\Support\Collection;
use Arkitecht\LaravelHume\Traits\HasPagination;

class CustomVoiceListResponse extends AbstractResponse
{
    use HasPagination;

    protected array|Collection $voicesPage;

    public function getCustomVoicesPage(): array|Collection
    {
        return $this->voicesPage;
    }

    public function setCustomVoicesPage(array $voicesPage): CustomVoiceListResponse
    {
        $this->voicesPage = $voicesPage;

        return $this;
    }

    public function __call(string $function, array $arguments)
    {
        return collect($this->voicesPage)->$function(...$arguments);
    }

    public function afterExtraction()
    {
        if (isset($this->voicesPage)) {
            $this->voicesPage = collect($this->voicesPage)->map(fn($config) => CustomVoice::fromJson($config));
        } else {
            $this->voicesPage = collect();
        }
    }
}
