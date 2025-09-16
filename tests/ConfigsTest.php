<?php

namespace Arkitecht\LaravelHume\Tests;

use Arkitecht\LaravelHume\Classes\Config;
use Arkitecht\LaravelHume\Exceptions\RequestException;
use Arkitecht\LaravelHume\Facades\Hume;

class ConfigsTest extends TestCase
{
    /** @test */
    function can_get_access_token()
    {
        $response = Hume::getAccessToken();

        $this->assertNotEmpty($response->token());
        $this->assertTrue(now()->isBefore($response->expiresAt()));
    }

    /** @test */
    function can_get_configs()
    {
        $response = Hume::listConfigs();

        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getConfigsPage());
    }

    /** @test */
    function can_get_configs_with_pagination()
    {
        $response = Hume::pageNumber(1)
            ->paginationDirection('asc')
            ->listConfigs();

        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getConfigsPage());

        $requestData = Hume::getLastRequest()->data();
        $this->assertEquals(1, $requestData['page_number']);
        $this->assertTrue($requestData['ascending_order']);

        $response = Hume::listConfigs();
        $requestData = Hume::getLastRequest()->data();
        $this->assertEquals(0, $requestData['page_number']);
        $this->assertFalse($requestData['ascending_order']);
    }

    /** @test */
    function can_create_config()
    {
        $configObject = $this->configObject();
        $response = Hume::createConfig($configObject);

        $this->assertNotEmpty($response);
        $this->assertNotEmpty($configObject->getName(), $response->getName());

        Hume::deleteConfig($response->getId());
    }

    /** @test */
    function can_get_config_versions()
    {
        $configs = Hume::listConfigs();
        $config = $configs->first();
        $configId = $config->getId();

        $response = Hume::listConfigVersions($configId);

        $this->assertNotEmpty($response);
        $this->assertEquals($response->first()->getId(), $config->getId());
    }

    /** @test */
    function can_create_config_version()
    {
        $configObject = $this->configObject();
        $config = Hume::createConfig($configObject);

        $this->assertNotEmpty($config);
        $this->assertEquals($configObject->getName(), $config->getName());

        $prompt = $this->configObject()->getPrompt()->setText('<role>You are an updated config</role>');
        $versionObject = $this->configObject()->setPrompt($prompt);

        $response = Hume::createConfigVersion($config->getId(), $versionObject);
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getId(), $config->getId());
        $this->assertEquals($versionObject->getPrompt()->getText(), '<role>You are an updated config</role>');
        $this->assertEquals(1, $response->getVersion());

        Hume::deleteConfig($config->getId());
    }

    /** @test */
    function can_delete_config()
    {
        $configObject = $this->configObject();
        $config = Hume::createConfig($configObject);

        $this->assertNotEmpty($config);

        //Confirm the new one is there
        $response = Hume::listConfigs(['name' => $config->getName()]);

        $response = Hume::deleteConfig($config->getId());
        $this->assertNotEmpty($response);
        $this->assertTrue($response);

        try {
            $response = Hume::listConfigs(['name' => $config->getName()]);
        } catch (RequestException $e) {
            $this->assertStringContainsString('Config (Name: ' . $config->getName() . ') does not exist', $e->getMessage());
        }
    }

    /** @test */
    function can_update_config_name()
    {
        $configObject = $this->configObject();
        $config = Hume::createConfig($configObject);

        $this->assertNotEmpty($config);

        //Confirm the new one is there
        Hume::listConfigs(['name' => $config->getName()]);

        $updatedName = $config->getName() . ' Updated';
        $response = Hume::updateConfigName($config->getId(), $updatedName);
        $this->assertNotEmpty($response);
        $this->assertTrue($response);

        try {
            $response = Hume::listConfigs(['name' => $config->getName()]);
        } catch (RequestException $e) {
            $this->assertStringContainsString('Config (Name: ' . $config->getName() . ') does not exist', $e->getMessage());
        }

        $response = Hume::listConfigs(['name' => $updatedName]);
        $this->assertNotEmpty($response);

        Hume::deleteConfig($config->getId());
    }

    /** @test */
    function can_get_config_version()
    {
        $configs = Hume::listConfigs();
        $config = $configs->first();

        $configId = $config->getId();
        $version = $config->getVersion();

        $response = Hume::getConfigVersion($configId, $version);

        $this->assertNotEmpty($response);
        $this->assertTrue(is_a($response, Config::class));
    }

    /** @test */
    function can_delete_config_version()
    {
        $configObject = $this->configObject();
        $config = Hume::createConfig($configObject);

        $this->assertNotEmpty($config);
        $this->assertEquals($configObject->getName(), $config->getName());

        $prompt = $this->configObject()->getPrompt()->setText('<role>You are an updated config</role>');
        $versionObject = $this->configObject()->setPrompt($prompt);

        $response = Hume::createConfigVersion($config->getId(), $versionObject);
        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getId(), $config->getId());
        $this->assertEquals($versionObject->getPrompt()->getText(), '<role>You are an updated config</role>');
        $this->assertEquals(1, $response->getVersion());

        $versions = Hume::listConfigVersions($config->getId(), ['restrict_to_most_recent' => false]);
        $this->assertEquals(2, $versions->count());

        $response = Hume::deleteConfigVersion($config->getId(), 1);
        $this->assertNotEmpty($response);

        $versions = Hume::listConfigVersions($config->getId(), ['restrict_to_most_recent' => false]);
        $this->assertEquals(1, $versions->count());

        try {
            $response = Hume::getConfigVersion($config->getId(), 1);
        } catch (RequestException $e) {
            $this->assertStringContainsString('Config (ID: ' . $config->getId() . ', VERSION: 1) does not exist', $e->getMessage());
        }

        Hume::deleteConfig($config->getId());
    }

    /** @test */
    function can_update_config_description()
    {
        $configObject = $this->configObject();
        $config = Hume::createConfig($configObject);

        $this->assertNotEmpty($config);
        $this->assertEquals($configObject->getName(), $config->getName());
        $this->assertEmpty($config->getVersionDescription());

        $response = Hume::updateConfigDescription($config->getId(), $config->getVersion(), 'Updated Description');
        $this->assertNotEmpty($response);
        $this->assertEquals($config->getName(), $response->getName());
        $this->assertEquals('Updated Description', $response->getVersionDescription());

        Hume::deleteConfig($config->getId());
    }

    /** @test */
    function can_handle_additional_undefined_properties()
    {
        $json = [
            "id"                  => "28aa41ec-3f7d-42db-90ba-cc676f727d43",
            "version"             => 0,
            "evi_version"         => "3",
            "version_description" => null,
            "name"                => "Test config 1758036781",
            "created_on"          => 1758036781763,
            "modified_on"         => 1758036781763,
            "prompt"              => [
                "id"                  => "c58c8a08-970c-4915-a374-08559a9db11e",
                "version"             => 0,
                "version_type"        => "FIXED",
                "version_description" => null,
                "name"                => "created_inline_071fabc0-6caa-48ab-a43a-35b8af8d2970",
                "created_on"          => 1758036781749,
                "modified_on"         => 1758036781749,
                "text"                => "<role> You are an AI retail sales coach to help sales reps in Boost Mobile prepaid cell phone stores. Your function is to offer training on a specific topic, tailored advice, conduct customer role plays, and provide detailed feedback to help reps excel in real world customer interactions. Format all messages as spoken words for a voice conversation. </role>",
            ],
            "voice"               => [
                "type"         => "OctaveShared",
                "id"           => "f60ecf9e-ff1e-4bae-9206-dba7c653a69e",
                "provider"     => "HUME_AI",
                "name"         => "Ito",
                "custom_voice" => [
                    "id"                   => "f60ecf9e-ff1e-4bae-9206-dba7c653a69e",
                    "version"              => 2,
                    "name"                 => "Ito",
                    "description"          => "A male adult voice made famous by EVI 1 and 2",
                    "reference_signed_uri" => [
                        "filename"                    => "c610f8d0-a3fb-4345-9473-024ba032a03f/reference_audio/81b18719-05e1-49f4-803d-8899300838f3.wav",
                        "method"                      => "GET",
                        "signed_uri"                  => "https://storage.googleapis.com/tts-projects-audio/c610f8d0-a3fb-4345-9473-024ba032a03f/reference_audio/81b18719-05e1-49f4-803d-8899300838f3.wav?X-Goog-Algorithm=GOOG4-RSA-SHA256&X-Goog-Credential=stenographer-server%40hume-data.iam.gserviceaccount.com%2F20250916%2Fauto%2Fstorage%2Fgoog4_request&X-Goog-Date=20250916T155409Z&X-Goog-Expires=3600&X-Goog-SignedHeaders=host&X-Goog-Signature=8da6cae29ebd6009f3b3aa58fec5b6fe151401f9c2b8513101e7cab98f00d6f5374a621112f0ea6a31e19354986ff7285561688e05d5c42fb5be70adfff6ec7cb3a8f56c1ff89b19d53786a92eb0b584d41b000bf5eff2f09e0a0071cef9a12c1c824f8996f11633b6e49a397557d18631811c141340707444cffdc67d94aa4d28d543afdd57a8f840e235be839a3a8fcafef177d467a802a6bc63135f7428ba5fdfe8c891922d21315d903c88f46c23f152f4a3f5a61dbb8e7c9b051cf94ddcd7c779b07ee068da9c2338b9bc928a940a0c2d24266103eb8089d5ffd2cf855ce6241ee9857a72af5bd4e393c5639ce8ebcb588dbfe9e65c5bf6795e99b7771e",
                        "expiration_timestamp_millis" => 1758041649158,
                    ],
                    "image_uri"            => null,
                    "tags"                 => [
                        "LANGUAGE" => [
                            0 => "English",
                        ],
                        "ACCENT"   => [
                            0 => "American",
                        ],
                    ],
                ],
            ],
            "language_model"      => [
                "model_provider"              => "ANTHROPIC",
                "model_resource"              => "claude-3-5-sonnet-latest",
                "temperature"                 => 1.0,
                "custom_language_model_model" => null,
            ],
            "ellm_model"          => [
                "allow_short_responses" => true,
            ],
            "tools"               => [],
            "builtin_tools"       => [],
            "event_messages"      => [
                "on_new_chat"             => [
                    "enabled" => true,
                    "text"    => "Thanks for visiting AI coach",
                ],
                "on_resume_chat"          => [
                    "enabled" => true,
                    "text"    => null,
                ],
                "on_inactivity_timeout"   => [
                    "enabled" => false,
                    "text"    => null,
                ],
                "on_max_duration_timeout" => [
                    "enabled" => false,
                    "text"    => null,
                ],
            ],
            "timeouts"            => [
                "inactivity"   => [
                    "enabled"       => true,
                    "duration_secs" => 120,
                ],
                "max_duration" => [
                    "enabled"       => true,
                    "duration_secs" => 1800,
                ],
            ],
            "nudges"              => [
                "enabled"       => false,
                "interval_secs" => null,
            ],
            "webhooks"            => [],
            'new_property' => 'test',
            'new_complex_property' => [
                'this',
                'is',
                'a',
                'test',
            ]
        ];

        $config = Config::fromJson($json);
        $this->assertEquals('test', $config->newProperty);
        $this->assertEquals([
            'this',
            'is',
            'a',
            'test',
        ], $config->newComplexProperty);
    }

    private function configObject(): Config
    {
        $config = Config::fromJson([
            "evi_version"    => "3",
            "name"           => "Test config " . time(),
            "prompt"         => [
                "version_type" => "FIXED",
                "text"         => "<role> You are an AI retail sales coach to help sales reps in Boost Mobile prepaid cell phone stores. Your function is to offer training on a specific topic, tailored advice, conduct customer role plays, and provide detailed feedback to help reps excel in real world customer interactions. Format all messages as spoken words for a voice conversation. </role>",
            ],
            "voice"          => [
                "provider" => "HUME_AI",
                "name"     => "ITO",
            ],
            "language_model" => [
                "model_provider" => "ANTHROPIC",
                "model_resource" => "claude-3-5-sonnet-latest",
                "temperature"    => 1.0,
            ],
            "ellm_model"     => [
                "allow_short_responses" => true,
            ],
            "event_messages" => [
                "on_new_chat" => [
                    "enabled" => true,
                    "text"    => "Thanks for visiting AI coach",
                ],
            ],
        ]);

        return $config;
    }
}
