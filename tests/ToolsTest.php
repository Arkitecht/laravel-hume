<?php

namespace Arkitecht\LaravelHume\Tests;

use Arkitecht\LaravelHume\Classes\Tool;
use Arkitecht\LaravelHume\Exceptions\RequestException;
use Arkitecht\LaravelHume\Facades\Hume;

class ToolsTest extends TestCase
{
    /** @test */
    function can_get_tools()
    {
        $tool = $this->createTool();
        $response = Hume::listTools();

        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getToolsPage());

        $this->deleteTool($tool->getId());
    }

    /** @test */
    function can_create_tool()
    {
        $response = $this->createTool('aaronTest');
        $this->assertNotEmpty($response);
        $this->assertEquals('aaronTest', $response->getName());

        $this->deleteTool($response->getId());
    }

    /** @test */
    function can_list_tool_versions()
    {
        $tool = $this->createTool();
        $response = Hume::listToolVersions($tool->getId());
        $this->assertNotEmpty($response);
        $version = $response->first();
        $this->assertEquals($tool->getId(), $version->getId());
        $this->assertEquals(0, $version->getVersion());

        $this->deleteTool($tool->getId());
    }

    /** @test */
    function can_get_tool_version()
    {
        $tool = $this->createTool();
        $response = Hume::getToolVersion($tool->getId(), $tool->getVersion());
        $this->assertNotEmpty($response);
        $this->assertEquals($tool->getVersion(), $response->getVersion());
        $this->assertEquals($tool->getId(), $response->getId());

        $this->deleteTool($tool->getId());
    }

    /** @test */
    function can_create_tool_version()
    {
        $tool = $this->createTool();
        $versions = Hume::listToolVersions($tool->getId());
        $this->assertEquals(1, $versions->count());

        $toolObject = $this->toolObject($tool->getName(), [
            'type'       => 'object',
            'properties' => [
                'location' => [
                    'type'        => 'string',
                    'description' => 'location',
                ],
            ],
            'required'   => ['location'],
        ]);
        $toolObject->setVersionDescription('Updated version');
        $response = Hume::createToolVersion($tool->getId(), $toolObject);

        $this->assertNotEmpty($response);
        $this->assertEquals(1, $response->getVersion());
        $this->assertEquals($tool->getId(), $response->getId());

        $this->deleteTool($tool->getId());
    }

    /** @test */
    function can_update_tool_name()
    {
        $tool = $this->createTool();
        $response = Hume::updateToolName($tool->getId(), 'aaronUpdateTest');
        $this->assertNotEmpty($response);
        $this->assertTrue($response);

        $updatedTool = Hume::getToolVersion($tool->getId(), $tool->getVersion());
        $this->assertEquals('aaronUpdateTest', $updatedTool->getName());

        $this->deleteTool($tool->getId());
    }


    /** @test */
    function can_delete_tool()
    {
        $tool = $this->createTool();

        $response = $this->deleteTool($tool->getId());

        $this->assertNotEmpty($response);
        $this->assertTrue($response);
    }

    /** @test */
    function can_delete_tool_version()
    {
        $tool = $this->createTool();
        $toolObject = $this->toolObject($tool->getName(), [
            'type'       => 'object',
            'properties' => [
                'location' => [
                    'type'        => 'string',
                    'description' => 'location',
                ],
            ],
            'required'   => ['location'],
        ]);
        $toolObject->setVersionDescription('Updated version');
        $version = Hume::createToolVersion($tool->getId(), $toolObject);

        $response = Hume::deleteToolVersion($tool->getId(), $version->getVersion());

        $this->assertNotEmpty($response);
        $this->assertTrue($response);

        try {
            $response = Hume::getToolVersion($tool->getId(), $version->getVersion());
        } catch (RequestException $e) {
            $this->assertStringContainsString('tool id ' . $tool->getId() . ' with version number ' . $version->getVersion(), $e->getMessage());
        }
        $this->assertNotEmpty($response);

        $this->deleteTool($tool->getId());
    }

    /** @test */
    function can_update_tool_version_description()
    {
        $tool = $this->createTool();

        $response = Hume::updateToolDescription($tool->getId(), $tool->getVersion(), 'An updated description');
        $this->assertEquals('An updated description', $response->getVersionDescription());

        $tool = Hume::getToolVersion($tool->getId(), $tool->getVersion());
        $this->assertEquals('An updated description', $tool->getVersionDescription());

        $this->deleteTool($tool->getId());
    }

    private function toolObject(?string $name = null, array $parameters = [])
    {
        if (is_null($name)) {
            $name = 'aaronTest' . time();
        }

        $parameters = array_merge([
            'type'       => 'object',
            'properties' => [
                'location' => [
                    'type'        => 'string',
                    'description' => 'Test location',
                ],
            ],
            'required'   => ['location'],
        ], $parameters);

        $tool = new Tool();
        $tool->setName($name)
            ->setDescription('Tool created from a test ' . time())
            ->setParameters($parameters);

        return $tool;
    }

    private function createTool(?string $name = null)
    {
        $tool = $this->toolObject($name);

        $response = Hume::createTool($tool);

        return $response;
    }

    private function deleteTool(string $toolId)
    {
        $response = Hume::deleteTool($toolId);

        return $response;
    }
}
