<?php


namespace telegramBotApiPhp\Types;

/**
 * Class VoiceChatEnded
 * @package telegramBotApiPhp\Types
 * @method int getDuration()
 * @method bool issetDuration()
 */
class VoiceChatEnded extends base
{
    static protected $map = [
        'duration' => true,
    ];
    protected $Duration;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}