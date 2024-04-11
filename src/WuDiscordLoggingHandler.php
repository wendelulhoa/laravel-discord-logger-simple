<?php

namespace WU\WuDiscordLogger;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class WuDiscordLoggingHandler extends AbstractProcessingHandler
{
    /* Configurações do channel. */ 
    private $configs;

    /* Informações vindas do log. */ 
    private $record;

    /**
     * Constructor da classe
     * 
     * Reference:
     * https://github.com/markhilton/monolog-mysql/blob/master/src/Logger/Monolog/Handler/MysqlHandler.php
     */
    public function __construct(array $configs)
    {
        /* Seta as configurações do canal. */ 
        $this->configs = array_merge($configs, config('wu-discord-logger'));
    }

    protected function write(array $record): void
    {
        try {
            /* Seta as informações vindas do log*/ 
            $this->record = $record;

            if(isset($this->configs['url'])) {
                Http::post($this->configs['url'], [
                    'content' => "",
                    'embeds' => [
                        [
                            'title'       => $this->getTitle(),
                            'description' => $this->getDescription(),
                            'color'       => $this->getColor()
                        ]
                    ],
                ]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Monta o título
     *
     * @return string
     */
    public function getTitle() 
    {
        /* Pega o o tipo de log. */ 
        $levelName   = $this->record['level_name'];
        $currentDate = Carbon::now()->format('Y-m-d H:i:s');
        $nameApp     = $this->configs['from']['name'];
        $emoji       = ($this->configs['emojis'][$levelName] ?? '');

        return "$emoji **``[$currentDate] $nameApp.$levelName``**";
    }

    /**
     * Monta a descrição.
     *
     * @return string
     */
    public function getDescription() 
    {
        /* Pega a mensagem. */ 
        $message = $this->record['message'];

        return ":black_small_square: ``$message``";
    }

    /**
     * Retorna a cor conforme o tipo de debug.
     *
     * @return void
     */ 
    public function getColor() 
    {
        $levelName = $this->record['level_name'];
        $color     = ($this->configs['colors'][$levelName] ?? '0x4caf50');

        return $color;
    }
}
