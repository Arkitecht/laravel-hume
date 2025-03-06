<?php

namespace Arkitecht\LaravelHume\Enums;

enum ChatAudioStatus: string
{
    case QUEUED = 'QUEUED';
    case IN_PROGRESS = 'IN_PROGRESS';
    case COMPLETE = 'COMPLETE';
    case ERROR = 'ERROR';
    case CANCELLED = 'CANCELLED';
}
