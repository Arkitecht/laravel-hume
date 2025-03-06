<?php

namespace Arkitecht\LaravelHume\Traits;

use Arkitecht\LaravelHume\Classes\CustomVoice;
use Arkitecht\LaravelHume\Responses\CustomVoiceListResponse;

trait ManagesCustomVoices
{
    /**
     * @param array $parameters Array containing the necessary params
     *                          + pagination
     *                          + restrict_to_most_recent (bool, optional, default true) Return only the latest version
     *                          of each prompt.
     *                          + name (string, optional) - Only include prompts matching this name.
     *
     * @return void
     */
    public function listCustomVoices(array $parameters = []): CustomVoiceListResponse
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/custom_voices', parameters: $parameters);

        return CustomVoiceListResponse::fromJson($response->json());
    }

    public function createCustomVoice(CustomVoice $voice): CustomVoice
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/custom_voices', method: 'post', parameters: $voice->toArray());

        return CustomVoice::fromJson($response->json());
    }

    public function getCustomVoice(string $customVoiceId): CustomVoice
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/custom_voices/' . $customVoiceId);

        return CustomVoice::fromJson($response->json());
    }

    public function createCustomVoiceVersion(string $customVoiceId, CustomVoice $voice): CustomVoice
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/custom_voices/' . $customVoiceId, method: 'post', parameters: $voice->toArray());

        return CustomVoice::fromJson($response->json());
    }

    public function updateCustomVoiceName(string $customVoiceId, string $name): bool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/custom_voices/' . $customVoiceId, method: 'patch', parameters: ['name' => $name]);

        return $response->successful();
    }

    public function deleteCustomVoice(string $customVoiceId): bool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/custom_voices/' . $customVoiceId, method: 'delete');

        return $response->successful();
    }
}
