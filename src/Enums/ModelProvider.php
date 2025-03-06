<?php

namespace Arkitecht\LaravelHume\Enums;

enum ModelProvider: string
{
    case OPEN_AI = 'OPEN_AI';
    case CUSTOM_LANGUAGE_MODEL = 'CUSTOM_LANGUAGE_MODEL';
    case ANTHROPIC = 'ANTHROPIC';
    case FIREWORKS = 'FIREWORKS';
    case GROQ = 'GROQ';
    case GOOGLE = 'GOOGLE';
}
