<?php

namespace Arkitecht\LaravelHume\Enums;

enum ChatStartType: string
{
    case NEW_CHAT_GROUP = 'new_chat_group';
    case RESUMED_CHAT_GROUP = 'resumed_chat_group';
}
