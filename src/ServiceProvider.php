<?php

namespace Wendelulhoa\WuDiscordLogger;

use Illuminate\Support\ServiceProvider;

class ConfigPublishServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if (!file_exists(config_path('wu-discord-logger.php'))) {
            $this->publishes([
                __DIR__ . '/../../config/wu-discord-logger.php' => config_path('wu-discord-logger.php'),
            ], 'config');
        }

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/wu-discord-logger.php', 'wu-discord-logger'
        );
    }

}
