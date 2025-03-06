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
        dump(Hume::getLastResponse());

        $this->assertNotEmpty($response);
        $this->assertEquals($response->first(), $config);
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
        dump($config->getId());

        $this->assertNotEmpty($config);
        $this->assertEquals($configObject->getName(), $config->getName());
        $this->assertEmpty($config->getVersionDescription());

        $response = Hume::updateConfigDescription($config->getId(), $config->getVersion(), 'Updated Description');
        $this->assertNotEmpty($response);
        $this->assertEquals($config->getName(), $response->getName());
        $this->assertEquals('Updated Description', $response->getVersionDescription());

        Hume::deleteConfig($config->getId());
    }

    private function configObject(): Config
    {
        $config = Config::fromJson([
            "evi_version"    => "2",
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
