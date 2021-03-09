<?php


namespace telegramBotApiPhp\Types;

/**
 * Class VoiceChatStarted
 * @package telegramBotApiPhp\Types

 */
class VoiceChatStarted extends base
{
    static protected $map = [

    ];


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}