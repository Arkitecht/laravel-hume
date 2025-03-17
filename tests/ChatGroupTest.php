<?php

namespace Arkitecht\LaravelHume\Tests;

use Arkitecht\LaravelHume\Facades\Hume;
use Arkitecht\LaravelHume\Classes\ChatAudio;

class ChatGroupTest extends \Arkitecht\LaravelHume\Tests\TestCase
{
    /** @test */
    function can_get_chat_groups()
    {
        $response = Hume::listChatGroups();

        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getChatGroupsPage());
    }

    /** @test */
    function can_get_chat_group()
    {
        $chatGroups = Hume::listChatGroups();
        $chatGroup = $chatGroups->first();
        $chatGroupId = $chatGroup->getId();

        $response = Hume::getChatGroup($chatGroupId);
        $this->assertNotEmpty($response);
        $this->assertEquals($chatGroup->getId(), $response->getId());
        $this->assertNotEmpty($response->getChatsPage());
    }

    /** @test */
    function can_get_chat_group_events()
    {
        $chatGroups = Hume::listChatGroups();
        $chatGroup = $chatGroups->first();
        $chatGroupId = $chatGroup->getId();

        $response = Hume::getChatGroupEvents($chatGroupId);
        $this->assertNotEmpty($response);
        $this->assertEquals($chatGroup->getId(), $response->getId());
        $this->assertNotEmpty($response->getEventsPage());
    }

    /** @test */
    function can_get_chat_group_audio()
    {
        $chatGroups = Hume::listChatGroups();
        $chatGroup = $chatGroups->first();
        $chatGroupId = $chatGroup->getId();

        $response = Hume::getChatGroupAudio($chatGroupId);
        $this->assertNotEmpty($response);
        $this->assertEquals($chatGroup->getId(), $response->getId());
        $this->assertNotEmpty($response->getAudioReconstructionsPage());
        $this->assertTrue(is_a($response->first(), ChatAudio::class));
    }
}
