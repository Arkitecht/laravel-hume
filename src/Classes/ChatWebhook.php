<?php

namespace Arkitecht\LaravelHume\Classes;

use Arkitecht\LaravelHume\Enums\ChatStartType;
use Arkitecht\LaravelHume\Enums\ChatStatus;
use Arkitecht\LaravelHume\Traits\HasPagination;
use Illuminate\Support\Collection;

class ChatWebhook extends AbstractClass
{
    protected string $chatGroupId;
    protected string $chatId;
    protected ?int $durationSeconds;
    protected ChatStartType $chatStartType;
    protected ?ChatStatus $endReason;
    protected ?int $startTime;
    protected ?int $endTime;
    protected ?string $callerNumber;
    protected string $configId;
    protected string $customSessionId;
    protected ?string $eventName;

    public function getChatGroupId(): string
    {
        return $this->chatGroupId;
    }

    public function setChatGroupId(string $chatGroupId): ChatWebhook
    {
        $this->chatGroupId = $chatGroupId;

        return $this;
    }

    public function getChatId(): string
    {
        return $this->chatId;
    }

    public function setChatId(string $chatId): ChatWebhook
    {
        $this->chatId = $chatId;

        return $this;
    }

    public function getDurationSeconds(): ?int
    {
        return $this->durationSeconds;
    }

    public function setDurationSeconds(?int $durationSeconds): ChatWebhook
    {
        $this->durationSeconds = $durationSeconds;

        return $this;
    }

    public function getEndReason(): ChatStatus
    {
        return $this->endReason;
    }

    public function setEndReason(ChatStatus $endReason): ChatWebhook
    {
        $this->endReason = $endReason;

        return $this;
    }

    public function getEndTime(): ?int
    {
        return $this->endTime;
    }

    public function setEndTime(?int $endTime): ChatWebhook
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getCallerNumber(): ?string
    {
        return $this->callerNumber;
    }

    public function setCallerNumber(?string $callerNumber): ChatWebhook
    {
        $this->callerNumber = $callerNumber;

        return $this;
    }

    public function getConfigId(): string
    {
        return $this->configId;
    }

    public function setConfigId(string $configId): ChatWebhook
    {
        $this->configId = $configId;

        return $this;
    }

    public function getCustomSessionId(): string
    {
        return $this->customSessionId;
    }

    public function setCustomSessionId(string $customSessionId): ChatWebhook
    {
        $this->customSessionId = $customSessionId;

        return $this;
    }

    public function getEventName(): ?string
    {
        return $this->eventName;
    }

    public function setEventName(?string $eventName): ChatWebhook
    {
        $this->eventName = $eventName;

        return $this;
    }

    public function getChatStartType(): ChatStartType
    {
        return $this->chatStartType;
    }

    public function setChatStartType(ChatStartType $chatStartType): ChatWebhook
    {
        $this->chatStartType = $chatStartType;

        return $this;
    }

    public function getStartTime(): ?int
    {
        return $this->startTime;
    }

    public function setStartTime(?int $startTime): ChatWebhook
    {
        $this->startTime = $startTime;

        return $this;
    }
}
