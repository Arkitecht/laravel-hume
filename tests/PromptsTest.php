<?php

namespace Arkitecht\LaravelHume\Tests;

use Arkitecht\LaravelHume\Classes\Prompt;
use Arkitecht\LaravelHume\Exceptions\RequestException;
use Arkitecht\LaravelHume\Facades\Hume;

class PromptsTest extends TestCase
{
    /** @test */
    function can_get_prompts()
    {
        $response = Hume::listPrompts();

        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getPromptsPage());
    }

    /** @test */
    function can_create_prompt()
    {
        $prompt = $this->promptObject();
        $response = Hume::createPrompt($prompt);

        $this->assertNotEmpty($response);
        $this->assertNotEmpty($prompt->getName(), $response->getName());
        $this->assertNotEmpty($response->getCreatedOn());

        Hume::deletePrompt($response->getId());
    }

    /** @test */
    function can_get_prompt_versions()
    {
        $prompt = $this->createPrompt();
        $response = Hume::listPromptVersions($prompt->getId());

        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getPromptsPage());
        $this->assertEquals($prompt->getId(), $response->first()->getId());
        $this->assertEquals(0, $response->first()->getVersion());

        Hume::deletePrompt($prompt->getId());
    }

    /** @test */
    function can_create_prompt_version()
    {
        $prompt = $this->createPrompt();

        $version = $this->promptObject($prompt->getName(), $prompt->getText() . 'updated')
            ->setVersionDescription('updated version');
        $response = Hume::createPromptVersion($prompt->getId(), $version);

        $this->assertNotEmpty($response);
        $this->assertEquals($prompt->getId(), $response->getId());
        $this->assertEquals('updated version', $response->getVersionDescription());
        $this->assertEquals(1, $response->getVersion());

        $list = Hume::listPromptVersions($prompt->getId(), ['restrict_to_most_recent' => false]);
        $this->assertEquals(2, $list->count());

        Hume::deletePrompt($prompt->getId());
    }

    /** @test */
    function can_delete_prompt()
    {
        $prompt = $this->createPrompt();

        $response = Hume::deletePrompt($prompt->getId());
        $this->assertTrue($response);

        try {
            $response = Hume::listPrompts(['name' => $prompt->getName()]);
        } catch (RequestException $exception) {
            $this->assertStringContainsString('Either prompt (Name: ' . $prompt->getName() . ') does not exist ', $exception->getMessage());
        }
    }

    /** @test */
    function can_update_prompt_name()
    {
        $prompt = $this->createPrompt();
        $response = Hume::updatePromptName($prompt->getId(), 'Updated Prompt Name');

        $this->assertNotEmpty($response);
        $this->assertTrue($response);

        $list = Hume::listPromptVersions($prompt->getId());
        $this->assertEquals('Updated Prompt Name', $list->first()->getName());

        Hume::deletePrompt($prompt->getId());
    }

    /** @test */
    function can_get_prompt_version()
    {
        $prompt = $this->createPrompt();
        $response = Hume::getPromptVersion($prompt->getId(), $prompt->getVersion());

        $this->assertNotEmpty($response);
        $this->assertEquals($prompt->getId(), $response->getId());
        $this->assertEquals($prompt->getVersion(), $response->getVersion());

        Hume::deletePrompt($prompt->getId());
    }

    /** @test */
    function can_delete_prompt_version()
    {
        $prompt = $this->createPrompt();

        $version = $this->promptObject($prompt->getName(), $prompt->getText() . 'updated')
            ->setVersionDescription('updated version');
        $version = Hume::createPromptVersion($prompt->getId(), $version);

        $this->assertNotEmpty($version);
        $this->assertEquals($prompt->getId(), $version->getId());
        $this->assertEquals('updated version', $version->getVersionDescription());
        $this->assertEquals(1, $version->getVersion());

        $list = Hume::listPromptVersions($prompt->getId(), ['restrict_to_most_recent' => false]);
        $this->assertEquals(2, $list->count());

        $response = Hume::deletePromptVersion($version->getId(), $version->getVersion());
        $this->assertTrue($response);

        $list = Hume::listPromptVersions($prompt->getId(), ['restrict_to_most_recent' => false]);
        $this->assertEquals(1, $list->count());

        Hume::deletePrompt($prompt->getId());
    }

    /** @test */
    function can_update_prompt_version_description()
    {
        $prompt = $this->createPrompt();

        $version = $this->promptObject($prompt->getName(), $prompt->getText() . 'updated')
            ->setVersionDescription('updated version');
        $version = Hume::createPromptVersion($prompt->getId(), $version);

        $this->assertNotEmpty($version);
        $this->assertEquals($prompt->getId(), $version->getId());
        $this->assertEquals('updated version', $version->getVersionDescription());
        $this->assertEquals(1, $version->getVersion());

        $response = Hume::updatePromptDescription($version->getId(), $version->getVersion(), 'really updated description');
        $this->assertNotEmpty($response);
        $this->assertEquals($prompt->getId(), $response->getId());
        $this->assertEquals(1, $response->getVersion());
        $this->assertEquals('really updated description', $response->getVersionDescription());

        $response = Hume::getPromptVersion($version->getId(), $version->getVersion());
        $this->assertNotEmpty($response);
        $this->assertEquals($prompt->getId(), $response->getId());
        $this->assertEquals('really updated description', $response->getVersionDescription());

        Hume::deletePrompt($prompt->getId());
    }


    private function createPrompt(?string $name = null, ?string $prompt = null): Prompt
    {
        $prompt = $this->promptObject($name, $prompt);

        return Hume::createPrompt($prompt);
    }


    private function promptObject(?string $name = null, ?string $prompt = null): Prompt
    {
        if (!$name) {
            $name = 'Test Prompt ' . time();
        }

        if (!$prompt) {
            $prompt = '<role>You are an AI web search assistant designed to help users find accurate and relevant information on the web. Respond to user queries promptly, using the built-in web search tool to retrieve up-to-date results. Present information clearly and concisely, summarizing key points where necessary. Use simple language and avoid technical jargon. If needed, provide helpful tips for refining search queries to obtain better results.</role>';
        }

        return (new Prompt())
            ->setName($name)
            ->setText($prompt);
    }
}
