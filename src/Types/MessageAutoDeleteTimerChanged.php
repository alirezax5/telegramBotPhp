<?php


namespace telegramBotApiPhp\Types;

/**
 * Class VideoChatEnded
 * @package telegramBotApiPhp\Types
 * @method int getMessageAutoDeleteTime()
 * @method bool issetMessageAutoDeleteTime()
 */
class MessageAutoDeleteTimerChanged extends base
{
    static protected $map = [
        'message_auto_delete_time' => true,
    ];
    protected $MessageAutoDeleteTime;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}