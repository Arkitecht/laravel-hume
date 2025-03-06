<?php

namespace Arkitecht\LaravelHume\Enums;

enum ChatEventType: string
{
    case SYSTEM_PROMPT = 'SYSTEM_PROMPT';
    case USER_MESSAGE = 'USER_MESSAGE';
    case USER_INTERRUPTION = 'USER_INTERRUPTION';
    case AGENT_MESSAGE = 'AGENT_MESSAGE';
    case FUNCTION_CALL = 'FUNCTION_CALL';
    case FUNCTION_CALL_RESPONSE = 'FUNCTION_CALL_RESPONSE';
}
