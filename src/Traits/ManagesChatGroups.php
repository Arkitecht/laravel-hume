<?php

namespace Arkitecht\LaravelHume\Traits;

use Arkitecht\LaravelHume\Classes\ChatGroup;
use Arkitecht\LaravelHume\Responses\ChatGroupAudioResponse;
use Arkitecht\LaravelHume\Responses\ChatGroupResponse;


trait ManagesChatGroups
{
    public function listChatGroups(array $parameters = []): ChatGroupResponse
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/chat_groups', parameters: $parameters);

        return ChatGroupResponse::fromJson($response->json());
    }

    public function getChatGroup(string $chatGroupId, array $parameters = []): ChatGroup
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/chat_groups/' . $chatGroupId, parameters: $parameters);

        return ChatGroup::fromJson($response->json());
    }

    public function getChatGroupEvents(string $chatGroupId, array $parameters = []): ChatGroup
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/chat_groups/' . $chatGroupId . '/events', parameters: $parameters);

        return ChatGroup::fromJson($response->json());
    }

    public function getChatGroupAudio(string $chatGroupId, array $parameters = []): ChatGroupAudioResponse
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/chat_groups/' . $chatGroupId . '/audio', parameters: $parameters);

        return ChatGroupAudioResponse::fromJson($response->json());
    }
}
