<?php

namespace Arkitecht\LaravelHume\Classes;

use Arkitecht\LaravelHume\Enums\ChatEventType;
use Arkitecht\LaravelHume\Enums\Role;

class ChatEvent extends AbstractClass
{
    protected string $id;
    protected string $chatId;
    protected int $timestamp;
    protected Role $role;
    protected ChatEventType $type;
    protected ?string $messageText;
    protected ?string $emotionFeatures;
    protected ?string $metadata;

}
