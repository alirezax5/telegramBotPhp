<?php


namespace telegramBotApiPhp\Types;

/**
 * Class VideoChatStarted
 * @package telegramBotApiPhp\Types

 */
class VideoChatStarted extends base
{
    static protected $map = [

    ];


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}