<?php

namespace Arkitecht\LaravelHume\Classes;

use Arkitecht\LaravelHume\Enums\ChatEventType;
use Arkitecht\LaravelHume\Enums\Role;

class ChatEvent extends AbstractClass
{
    protected string $id;
    protected string $chatId;
    protected int $timestamp;
    protected Role $role;
    protected ChatEventType $type;
    protected ?string $messageText;
    protected array|object|null $emotionFeatures;
    protected array|object|null $metadata;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): ChatEvent
    {
        $this->id = $id;

        return $this;
    }

    public function getChatId(): string
    {
        return $this->chatId;
    }

    public function setChatId(string $chatId): ChatEvent
    {
        $this->chatId = $chatId;

        return $this;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp): ChatEvent
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): ChatEvent
    {
        $this->role = $role;

        return $this;
    }

    public function getType(): ChatEventType
    {
        return $this->type;
    }

    public function setType(ChatEventType $type): ChatEvent
    {
        $this->type = $type;

        return $this;
    }

    public function getMessageText(): ?string
    {
        return $this->messageText;
    }

    public function setMessageText(?string $messageText): ChatEvent
    {
        $this->messageText = $messageText;

        return $this;
    }

    public function getEmotionFeatures(): ?string
    {
        return $this->emotionFeatures;
    }

    public function setEmotionFeatures(array|object $emotionFeatures): ChatEvent
    {
        $this->emotionFeatures = $emotionFeatures;

        return $this;
    }

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function setMetadata(array|object $metadata): ChatEvent
    {
        $this->metadata = $metadata;

        return $this;
    }
}
