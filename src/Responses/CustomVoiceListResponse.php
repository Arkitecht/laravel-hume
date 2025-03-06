<?php

namespace Arkitecht\LaravelHume\Responses;

use Arkitecht\LaravelHume\Classes\CustomVoice;
use Illuminate\Support\Collection;
use Arkitecht\LaravelHume\Traits\HasPagination;

class CustomVoiceListResponse extends AbstractResponse
{
    use HasPagination;

    protected array|Collection $customVoicesPage;

    public function getCustomVoicesPage(): array|Collection
    {
        return $this->customVoicesPage;
    }

    public function setCustomVoicesPage(array $customVoicesPage): CustomVoiceListResponse
    {
        $this->customVoicesPage = $customVoicesPage;

        return $this;
    }

    public function __call(string $function, array $arguments)
    {
        return collect($this->customVoicesPage)->$function(...$arguments);
    }

    public function afterExtraction()
    {
        if (isset($this->customVoicesPage)) {
            $this->customVoicesPage = collect($this->customVoicesPage)->map(fn($config) => CustomVoice::fromJson($config));
        } else {
            $this->customVoicesPage = collect();
        }
    }
}
