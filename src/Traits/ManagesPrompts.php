<?php

namespace Arkitecht\LaravelHume\Traits;

use Arkitecht\LaravelHume\Classes\Prompt;
use Arkitecht\LaravelHume\Responses\PromptListResponse;

trait ManagesPrompts
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
    public function listPrompts(array $parameters = []): PromptListResponse
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/prompts', parameters: $parameters);

        return PromptListResponse::fromJson($response->json());
    }

    public function createPrompt(Prompt $prompt): Prompt
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/prompts', method: 'post', parameters: $prompt->toArray());

        return Prompt::fromJson($response->json());
    }

    public function deletePrompt(string $promptId): bool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/prompts/' . $promptId, method: 'delete');

        return $response->successful();
    }

    public function listPromptVersions(string $promptId, array $parameters = []): PromptListResponse
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/prompts/' . $promptId, parameters: $parameters);

        return PromptListResponse::fromJson($response->json());
    }

    public function createPromptVersion(string $promptId, Prompt $prompt): Prompt
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/prompts/' . $promptId, method: 'post', parameters: $prompt->toArray());

        return Prompt::fromJson($response->json());
    }

    public function updatePromptName(string $promptId, string $name): bool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/prompts/' . $promptId, method: 'patch', parameters: ['name' => $name]);

        return $response->successful();
    }

    public function getPromptVersion(string $promptId, int $version): Prompt
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/prompts/' . $promptId . '/version/' . $version);

        return Prompt::fromJson($response->json());
    }

    public function deletePromptVersion(string $promptId, int $version): bool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/prompts/' . $promptId . '/version/' . $version, method: 'delete');

        return $response->successful();
    }

    public function updatePromptDescription(string $promptId, int $version, string $description): Prompt
    {
        $response = $this->request(
            uri: 'https://api.hume.ai/v0/evi/prompts/' . $promptId . '/version/' . $version,
            method: 'patch',
            parameters: ['version_description' => $description]
        );

        return Prompt::fromJson($response->json());
    }
}
