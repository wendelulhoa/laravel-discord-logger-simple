<?php

namespace WU\WuDiscordLogger;

use Monolog\Logger;

class WuDiscordLogger {
    /**
     * Cria uma instância Monolog personalizada.
     *
     * @return \Monolog\Logger
     */
    public function __invoke(array $configs)
    {
        return (new Logger(''))->pushHandler(new WuDiscordLoggingHandler($configs));
    }
}