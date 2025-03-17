<?php

namespace Arkitecht\LaravelHume\Tests;

use Arkitecht\LaravelHume\Classes\Chat;
use Arkitecht\LaravelHume\Facades\Hume;
use Arkitecht\LaravelHume\Classes\ChatAudio;

class ChatsTest extends \Arkitecht\LaravelHume\Tests\TestCase
{

    /** @test */
    function can_get_chats()
    {
        $response = Hume::listChats();

        $this->assertNotEmpty($response);
        $this->assertNotEmpty($response->getChatsPage());
        $this->assertTrue(is_a($response->first(), Chat::class));
    }

    /** @test */
    function can_get_chat()
    {
        $chats = Hume::listChats();
        $chat = $chats->first();
        $chatId = $chat->getId();

        $response = Hume::getChat($chatId);

        $this->assertNotEmpty($response);
        $this->assertEquals($chatId, $response->getId());
    }

    /** @test */
    function can_get_chat_audio()
    {
        $chats = Hume::listChats();
        $chat = $chats->first();
        $chatId = $chat->getId();

        $response = Hume::getChatAudio($chatId);

        $this->assertNotEmpty($response);
        $this->assertTrue(is_a($response, ChatAudio::class));
        $this->assertEquals($chatId, $response->getId());
    }
}
