<?php

namespace Arkitecht\LaravelHume\Classes;

use Arkitecht\LaravelHume\Enums\ChatStatus;
use Arkitecht\LaravelHume\Traits\HasPagination;
use Illuminate\Support\Collection;

class Chat extends AbstractClass
{
    use HasPagination;

    protected string $id;
    protected string $chatGroupId;
    protected ChatStatus $status;
    protected ?int $startTimestamp;
    protected int|null $endTimestamp = null;
    protected ?int $eventCount;
    protected array|Collection|null $eventsPage;
    protected object|array|null $metadata = null;
    protected ?string $tag;
    protected Config $config;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Chat
    {
        $this->id = $id;

        return $this;
    }

    public function getChatGroupId(): string
    {
        return $this->chatGroupId;
    }

    public function setChatGroupId(string $chatGroupId): Chat
    {
        $this->chatGroupId = $chatGroupId;

        return $this;
    }

    public function getStatus(): ChatStatus
    {
        return $this->status;
    }

    public function setStatus(ChatStatus $status): Chat
    {
        $this->status = $status;

        return $this;
    }

    public function getStartTimestamp(): ?int
    {
        return $this->startTimestamp;
    }

    public function setStartTimestamp(?int $startTimestamp): Chat
    {
        $this->startTimestamp = $startTimestamp;

        return $this;
    }

    public function getEndTimestamp(): ?int
    {
        return $this->endTimestamp;
    }

    public function setEndTimestamp(?int $endTimestamp): Chat
    {
        $this->endTimestamp = $endTimestamp;

        return $this;
    }

    public function getEventCount(): ?int
    {
        return $this->eventCount;
    }

    public function setEventCount(?int $eventCount): Chat
    {
        $this->eventCount = $eventCount;

        return $this;
    }

    public function getEventsPage(): array|Collection|null
    {
        return $this->eventsPage;
    }

    public function setEventsPage(array|Collection|null $eventsPage): Chat
    {
        $this->eventsPage = $eventsPage;

        return $this;
    }

    public function getMetadata(): array|object|null
    {
        return $this->metadata;
    }

    public function setMetadata(?string $metadata): Chat
    {
        $this->metadata = $metadata;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setTag(?string $tag): Chat
    {
        $this->tag = $tag;

        return $this;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }

    public function setConfig(Config $config): Chat
    {
        $this->config = $config;

        return $this;
    }

    public function afterExtraction()
    {
        if (isset($this->eventsPage)) {
            $this->eventsPage = collect($this->eventsPage)->map(fn($chatEvent) => ChatEvent::fromJson($chatEvent));
        }
    }
}
