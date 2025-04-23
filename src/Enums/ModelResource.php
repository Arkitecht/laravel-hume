<?php

namespace Arkitecht\LaravelHume\Enums;

enum ModelResource: string
{
    case CLAUDE_3_7_SONNET_LATEST = 'claude-3-7-sonnet-latest';
    case CLAUDE_3_5_SONNET_LATEST = 'claude-3-5-sonnet-latest';
    case CLAUDE_3_5_HAIKU_LATEST = 'claude-3-5-haiku-latest';
    case CLAUDE_3_5_SONNET_20240620 = 'claude-3-5-sonnet-20240620';
    case CLAUDE_3_5_HAIKU_20241022 = 'claude-3-5-haiku-20241022';
    case CLAUDE_3_OPUS_20240229 = 'claude-3-opus-20240229';
    case CLAUDE_3_SONNET_20240229 = 'claude-3-sonnet-20240229';
    case CLAUDE_3_HAIKU_20240307 = 'claude-3-haiku-20240307';
    case CLAUDE_2_1 = 'claude-2.1';
    case CLAUDE_INSTANT_1_2 = 'claude-instant-1.2';
    case GEMINI_1_5_PRO = 'gemini-1.5-pro';
    case GEMINI_1_5_FLASH = 'gemini-1.5-flash';
    case GEMINI_1_5_PRO_002 = 'gemini-1.5-pro-002';
    case GEMINI_1_5_FLASH_002 = 'gemini-1.5-flash-002';
    case GPT_4_TURBO_PREVIEW = 'gpt-4-turbo-preview';
    case GPT_3_5_TURBO_0125 = 'gpt-3.5-turbo-0125';
    case GPT_3_5_TURBO = 'gpt-3.5-turbo';
    case GPT_4O = 'gpt-4o';
    case GPT_4O_MINI = 'gpt-4o-mini';
    case GEMMA_7B_IT = 'gemma-7b-it';
    case LLAMA3_8B_8192 = 'llama3-8b-8192';
    case LLAMA3_70B_8192 = 'llama3-70b-8192';
    case LLAMA_3_1_70B_VERSATILE = 'llama-3.1-70b-versatile';
    case LLAMA_3_3_70B_VERSATILE = 'llama-3.3-70b-versatile';
    case LLAMA_3_1_8B_INSTANT = 'llama-3.1-8b-instant';
    case ACCOUNTS_FIREWORKS_MODELS_MIXTRAL_8X7B_INSTRUCT = 'accounts/fireworks/models/mixtral-8x7b-instruct';
    case ACCOUNTS_FIREWORKS_MODELS_LLAMA_V3P1_405B_INSTRUCT = 'accounts/fireworks/models/llama-v3p1-405b-instruct';
    case ACCOUNTS_FIREWORKS_MODELS_LLAMA_V3P1_70B_INSTRUCT = 'accounts/fireworks/models/llama-v3p1-70b-instruct';
    case ACCOUNTS_FIREWORKS_MODELS_LLAMA_V3P1_8B_INSTRUCT = 'accounts/fireworks/models/llama-v3p1-8b-instruct';
    case ELLM = 'ellm';

}
