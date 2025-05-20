<?php

namespace Arkitecht\LaravelHume\Classes;


use Arkitecht\LaravelHume\Enums\ChatAudioStatus;
use Carbon\Carbon;

class ChatAudio extends AbstractClass
{
    protected string $id;
    protected string $userId;
    protected ChatAudioStatus $status;

    protected ?string $filename = null;
    protected ?int $modifiedAt = null;

    protected ?string $signedAudioUrl = null;

    protected ?int $signedUrlExpirationTimestampMillis = null;

    protected Carbon $createdAt;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): ChatAudio
    {
        $this->id = $id;

        return $this;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): ChatAudio
    {
        $this->userId = $userId;

        return $this;
    }

    public function getStatus(): ChatAudioStatus
    {
        return $this->status;
    }

    public function setStatus(ChatAudioStatus $status): ChatAudio
    {
        $this->status = $status;

        return $this;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): ChatAudio
    {
        $this->filename = $filename;

        return $this;
    }

    public function getModifiedAt(): ?int
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?int $modifiedAt): ChatAudio
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function getSignedAudioUrl(): ?string
    {
        return $this->signedAudioUrl;
    }

    public function setSignedAudioUrl(?string $signedAudioUrl): ChatAudio
    {
        $this->signedAudioUrl = $signedAudioUrl;

        return $this;
    }

    public function getSignedUrlExpirationTimestampMillis(): ?int
    {
        return $this->signedUrlExpirationTimestampMillis;
    }

    public function setSignedUrlExpirationTimestampMillis(?int $signedUrlExpirationTimestampMillis): ChatAudio
    {
        $this->signedUrlExpirationTimestampMillis = $signedUrlExpirationTimestampMillis;

        return $this;
    }

    public function expiresAt(): Carbon
    {
        return Carbon::createFromTimestampMs($this->signedUrlExpirationTimestampMillis);
    }

    public function afterExtraction()
    {
        if (!isset($this->createdAt)) {
            $this->createdAt = now();
        }
    }
}
