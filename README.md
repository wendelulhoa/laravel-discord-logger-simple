# Laravel Discord Logger

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marvinlabs/laravel-discord-logger.svg?style=flat-square)](https://packagist.org/packages/marvinlabs/laravel-discord-logger)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/marvinlabs/laravel-discord-logger.svg?style=flat-square)](https://packagist.org/packages/marvinlabs/laravel-discord-logger)

`wu/laravel-discord-logger-simple` is a laravel package providing a logging handler to send logs to a Discord channel. 

## Installation

You can install the package via composer:

``` bash
composer wu/laravel-discord-logger-simple
```

## Setup

### Prepare the discord channel web hook

Create a discord web hook for the channel which will receive the logs.

### Prepare the logger configuration

You must add a new channel to your `config/logging.php` file:

```php
// config/logging.php
'channels' => [
    //...
    'discord' => [
        'driver' => 'custom',
        'via'    => WU\WuDiscordLogger\WuDiscordLogger::class,
        'level'  => 'debug',
        'url'    => env('LOG_DISCORD_WEBHOOK_URL'),
        'ignore_exceptions' => env('LOG_DISCORD_IGNORE_EXCEPTIONS', false),
    ],
];
```

You can then provide the web-hook URL in your `.env` file:

```
LOG_DISCORD_WEBHOOK_URL=https://discordapp.com/api/webhooks/abcerd/1234
```

### Use the logger channel

You have two options: log only to discord or add the channel to the stack

#### Logging to multiple Discord channels

Of course, you can send your log messages to multiple Discord channels. Just create as many channels as desired in 
`config/logging.php` and put them in the stack. Each channel should be named differently and should point to a different
web hook URL.

## Version history

See the [dedicated change log](CHANGELOG.md)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
