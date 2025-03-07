# Laravel Hume

**Laravel Hume** is a PHP package that provides a Laravel wrapper for the [Hume AI](https://hume.ai/) API, enabling seamless integration of Hume's empathic AI capabilities into Laravel applications.

## Features

- **Empathic Voice Interface (EVI):** A completely native PHP wrapper around the EVI REST API 

## Installation

To install the Laravel Hume package, run the following command in your terminal:

```bash
composer require arkitecht/laravel-hume
```

After installation, publish the configuration file using:

```bash
php artisan vendor:publish --provider="Arkitecht\LaravelHume\HumeServiceProvider"
```

## Configuration

Add your environment variables to your .env file

```env
HUME_API_KEY=your-api-key-here
HUME_API_SECRET=your-api-key-here
```

If you prefer the API to request and use an auth token, rather than the key and secret, add the following

```env 
HUME_API_AUTH=token 
```

## Usage

The library provides a Facade for making calls easily

```php
<?php

use Arkitecht\LaravelHume\Facades\Hume;

$chats = Hume::listChats();
$chat = $chats->first();

print "The first chat is: " . $chat->getId() . ' with a status of ' . $chat->getStatus();
```

```php
<?php

use Arkitecht\LaravelHume\Facades\Hume;
use Arkitecht\LaravelHume\Classes\Prompt;

$prompt = new Prompt();
$prompt->setName('Cool New Prompt')
    ->setText('<role>You are a helpful bot</role>');
    
Hume::createPrompt($prompt);
```

Or use the base API Class

```php
<?php

use Arkitecht\LaravelHume\Hume;

$humeService = new Hume('api_key','api_secret');

$chats = $humeService->usingAccessToken()->listChats();
$chat = $chats->first();

print "The first chat is: " . $chat->getId() . ' with a status of ' . $chat->getStatus();
```

```php
<?php

use Arkitecht\LaravelHume\Hume;
use Arkitecht\LaravelHume\Classes\Prompt;

$humeService = new Hume('api_key','api_secret');

$prompt = new Prompt();
$prompt->setName('Cool New Prompt')
    ->setText('<role>You are a helpful bot</role>');
    
$humeService->createPrompt($prompt);
```
