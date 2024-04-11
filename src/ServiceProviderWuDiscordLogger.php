<?php

namespace Wendelulhoa\WuDiscordLogger;

use Illuminate\Support\ServiceProvider;

class ServiceProviderWuDiscordLogger extends ServiceProvider
{
     /** @return void */
     public function register()
     {
         if (!Str::contains($this->app->version(), 'Lumen')) {
             $this->mergeConfigFrom(__DIR__ . '/../../config/wu-discord-logger.php', 'wu-discord-logger');
         }
         $this->registerContainerBindings();
     }
 
     /** @return void */
     public function boot()
     {
         if (Str::contains($this->app->version(), 'Lumen')) {
             $this->app->configure('wu-discord-logger');
         } else {
             $this->publishes([__DIR__ . '/../../config/wu-discord-logger.php' => config_path('wu-discord-logger.php')], 'config');
         }
     }
}
