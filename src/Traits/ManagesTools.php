<?php

namespace Arkitecht\LaravelHume\Traits;

use Arkitecht\LaravelHume\Classes\Tool;
use Arkitecht\LaravelHume\Responses\ToolListResponse;

trait ManagesTools
{
    /**
     * @param array $parameters Array containing the necessary params
     *                          + pagination
     *                          + restrict_to_most_recent (bool, optional, default true) Return only the latest version
     *                          of each tool.
     *                          + name (string, optional) - Only include configs matching this name.
     *
     * @return void
     */
    public function listTools(array $parameters = []): ToolListResponse
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/tools', parameters: $parameters);

        return ToolListResponse::fromJson($response->json());
    }

    public function createTool(Tool $tool): Tool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/tools', method: 'post', parameters: $tool->toArray());

        return Tool::fromJson($response->json());
    }

    public function updateToolName(string $toolId, string $name): bool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/tools/' . $toolId, method: 'patch', parameters: ['name' => $name]);

        return (bool)$response->json();
    }

    public function updateToolDescription(string $toolId, int $version, string $description): Tool
    {
        $response = $this->request(
            uri: 'https://api.hume.ai/v0/evi/tools/' . $toolId . '/version/' . $version,
            method: 'patch',
            parameters: ['version_description' => $description]
        );

        return Tool::fromJson($response->json());
    }

    public function listToolVersions(string $toolId, array $parameters = [])
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/tools/' . $toolId, parameters: $parameters);

        return ToolListResponse::fromJson($response->json());
    }

    public function getToolVersion(string $toolId, int $version): Tool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/tools/' . $toolId . '/version/' . $version);

        return Tool::fromJson($response->json());
    }

    public function createToolVersion(string $toolId, Tool $tool): Tool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/tools/' . $toolId, method: 'post', parameters: $tool->toArray());

        return Tool::fromJson($response->json());
    }

    public function deleteTool(string $toolId): bool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/tools/' . $toolId, method: 'delete');

        return $response->successful();
    }

    public function deleteToolVersion(string $toolId, int $version): bool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/tools/' . $toolId . '/version/' . $version, method: 'delete');

        return $response->successful();
    }
}
