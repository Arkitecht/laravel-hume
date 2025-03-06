<?php

namespace Arkitecht\LaravelHume\Classes;

use Arkitecht\LaravelHume\Traits\HasPagination;
use Illuminate\Support\Collection;

class ChatGroup extends AbstractClass
{
    use HasPagination;

    protected string $id;
    protected int $firstStartTimestamp;
    protected int $mostRecentStartTimestamp;
    protected int $numChats;
    protected string $mostRecentChatId;
    protected Config $mostRecentConfig;
    protected bool $isActive;
    protected array|Collection|null $chatsPage;
    protected array|Collection|null $eventsPage;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): ChatGroup
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstStartTimestamp(): int
    {
        return $this->firstStartTimestamp;
    }

    public function setFirstStartTimestamp(int $firstStartTimestamp): ChatGroup
    {
        $this->firstStartTimestamp = $firstStartTimestamp;

        return $this;
    }

    public function getMostRecentStartTimestamp(): int
    {
        return $this->mostRecentStartTimestamp;
    }

    public function setMostRecentStartTimestamp(int $mostRecentStartTimestamp): ChatGroup
    {
        $this->mostRecentStartTimestamp = $mostRecentStartTimestamp;

        return $this;
    }

    public function getNumChats(): int
    {
        return $this->numChats;
    }

    public function setNumChats(int $numChats): ChatGroup
    {
        $this->numChats = $numChats;

        return $this;
    }

    public function getMostRecentChatId(): string
    {
        return $this->mostRecentChatId;
    }

    public function setMostRecentChatId(string $mostRecentChatId): ChatGroup
    {
        $this->mostRecentChatId = $mostRecentChatId;

        return $this;
    }

    public function getMostRecentConfig(): Config
    {
        return $this->mostRecentConfig;
    }

    public function setMostRecentConfig(Config $mostRecentConfig): ChatGroup
    {
        $this->mostRecentConfig = $mostRecentConfig;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): ChatGroup
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getChatsPage(): Collection|array|null
    {
        return $this->chatsPage;
    }

    public function setChatsPage(Collection|array|null $chatsPage): ChatGroup
    {
        $this->chatsPage = $chatsPage;

        return $this;
    }

    public function getEventsPage(): Collection|array|null
    {
        return $this->eventsPage;
    }

    public function setEventsPage(Collection|array|null $eventsPage): ChatGroup
    {
        $this->eventsPage = $eventsPage;

        return $this;
    }

    public function afterExtraction()
    {
        if (isset($this->chatsPage)) {
            $this->chatsPage = collect($this->chatsPage)->map(fn($chat) => Chat::fromJson($chat));
        }

        if (isset($this->eventsPage)) {
            $this->eventsPage = collect($this->eventsPage)->map(fn($chatEvent) => ChatEvent::fromJson($chatEvent));
        }
    }
}
