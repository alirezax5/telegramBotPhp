<?php


namespace telegramBotApiPhp\Types;

/**
 * Class VideoChatEnded
 * @package telegramBotApiPhp\Types
 * @method int getDuration()
 * @method bool issetDuration()
 */
class VideoChatEnded extends base
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