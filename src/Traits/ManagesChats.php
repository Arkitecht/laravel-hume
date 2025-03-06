<?php

namespace Arkitecht\LaravelHume\Traits;

use Arkitecht\LaravelHume\Classes\Chat;
use Arkitecht\LaravelHume\Classes\ChatAudio;
use Arkitecht\LaravelHume\Responses\ChatListResponse;

trait ManagesChats
{
    public function listChats(array $parameters = []): ChatListResponse
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/chats', parameters: $parameters);

        return ChatListResponse::fromJson($response->json());
    }

    public function getChat(string $chatId, array $parameters = []): Chat
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/chats/' . $chatId, parameters: $parameters);

        return Chat::fromJson($response->json());
    }

    public function getChatAudio(string $chatId): ChatAudio
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/chats/' . $chatId . '/audio');

        return ChatAudio::fromJson($response->json());
    }
}
