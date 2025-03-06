<?php

namespace Arkitecht\LaravelHume\Enums;

enum ChatStatus: string
{
    case ACTIVE = 'ACTIVE';
    case USER_ENDED = 'USER_ENDED';
    case USER_TIMEOUT = 'USER_TIMEOUT';
    case MAX_DURATION_TIMEOUT = 'MAX_DURATION_TIMEOUT';
    case INACTIVITY_TIMEOUT = 'INACTIVITY_TIMEOUT';
    case ERROR = 'ERROR';
}
