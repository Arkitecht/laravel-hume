<?php

namespace Arkitecht\LaravelHume\Responses;

use Arkitecht\LaravelHume\Classes\Chat;
use Arkitecht\LaravelHume\Classes\ChatGroup;
use Arkitecht\LaravelHume\Traits\HasPagination;
use Illuminate\Support\Collection;

class ChatGroupResponse extends AbstractResponse
{
    use HasPagination;

    protected array|Collection|null $chatGroupsPage;

    public function getChatGroupsPage(): array|Collection
    {
        return $this->chatGroupsPage;
    }

    public function __call(string $function, array $arguments)
    {
        return collect($this->chatGroupsPage)->$function(...$arguments);
    }

    public function afterExtraction()
    {
        $this->chatGroupsPage = $this->map(fn($chatGroup) => ChatGroup::fromJson($chatGroup));
    }
}
