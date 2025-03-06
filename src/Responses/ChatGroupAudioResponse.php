<?php

namespace Arkitecht\LaravelHume\Responses;

use Arkitecht\LaravelHume\Classes\ChatAudio;
use Arkitecht\LaravelHume\Classes\ChatGroup;
use Arkitecht\LaravelHume\Traits\HasPagination;
use Illuminate\Support\Collection;

class ChatGroupAudioResponse extends AbstractResponse
{
    use HasPagination;

    protected string $id;
    protected string $userId;
    protected int $numChats;
    protected array|Collection|null $audioReconstructionsPage;

    public function getAudioReconstructionsPage(): array|Collection|null
    {
        return $this->audioReconstructionsPage;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): ChatGroupAudioResponse
    {
        $this->id = $id;

        return $this;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setUserId(string $userId): ChatGroupAudioResponse
    {
        $this->userId = $userId;

        return $this;
    }

    public function getNumChats(): int
    {
        return $this->numChats;
    }

    public function setNumChats(int $numChats): ChatGroupAudioResponse
    {
        $this->numChats = $numChats;

        return $this;
    }

    public function __call(string $function, array $arguments)
    {
        return collect($this->audioReconstructionsPage)->$function(...$arguments);
    }

    public function afterExtraction()
    {
        $this->audioReconstructionsPage = $this->map(fn($chatGroupAudio) => ChatAudio::fromJson($chatGroupAudio));
    }

}
