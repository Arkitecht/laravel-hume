<?php

namespace Arkitecht\LaravelHume\Responses;

use Arkitecht\LaravelHume\Classes\Chat;
use Arkitecht\LaravelHume\Traits\HasPagination;
use Illuminate\Support\Collection;

class ChatListResponse extends AbstractResponse
{
    use HasPagination;

    protected array|Collection $chatsPage;

    public function getChatsPage(): array|Collection
    {
        return $this->chatsPage;
    }

    public function __call(string $function, array $arguments)
    {
        return collect($this->chatsPage)->$function(...$arguments);
    }
    public function afterExtraction()
    {
        $this->chatsPage = $this->map(fn($chat) => Chat::fromJson($chat));
    }
}
