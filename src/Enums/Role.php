<?php

namespace Arkitecht\LaravelHume\Enums;

enum Role: string
{
    case USER = 'USER';
    case AGENT = 'AGENT';
    case SYSTEM = 'SYSTEM';
    case TOOL = 'TOOL';
}
