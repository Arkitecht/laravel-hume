<?php

namespace Arkitecht\LaravelHume\Traits;

use Arkitecht\LaravelHume\Classes\Config;
use Arkitecht\LaravelHume\Responses\ConfigListResponse;

trait ManagesConfigs
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
    public function listConfigs(array $parameters = []): ConfigListResponse
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/configs', parameters: $parameters);

        return ConfigListResponse::fromJson($response->json());
    }

    public function createConfig(Config $config): Config
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/configs', method: 'post', parameters: $config->toArray());

        return Config::fromJson($response->json());
    }

    public function listConfigVersions(string $configId, array $parameters = []): ConfigListResponse
    {
        $this->getPaginationFromParameters($parameters);

        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/configs/' . $configId, parameters: $parameters);

        return ConfigListResponse::fromJson($response->json());
    }

    public function createConfigVersion(string $configId, Config|array $version): Config
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/configs/' . $configId, method: 'post', parameters: (is_array($version)?$version:$version->toArray()));

        return Config::fromJson($response->json());
    }

    public function deleteConfig(string $configId): bool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/configs/' . $configId, method: 'delete');

        return $response->successful();
    }

    public function updateConfigName(string $configId, string $name): bool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/configs/' . $configId, method: 'patch', parameters: ['name' => $name]);

        return $response->successful();
    }

    public function getConfigVersion(string $configId, int $version, array $parameters = []): Config
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/configs/' . $configId . '/version/' . $version, parameters: $parameters);

        return Config::fromJson($response->json());
    }

    public function deleteConfigVersion(string $configId, int $version): bool
    {
        $response = $this->request(uri: 'https://api.hume.ai/v0/evi/configs/' . $configId . '/version/' . $version, method: 'delete');

        return $response->successful();
    }

    public function updateConfigDescription(string $configId, int $version, string $description): Config
    {
        $response = $this->request(
            uri: 'https://api.hume.ai/v0/evi/configs/' . $configId . '/version/' . $version,
            method: 'patch',
            parameters: ['version_description' => $description]
        );

        return Config::fromJson($response->json());
    }
}
