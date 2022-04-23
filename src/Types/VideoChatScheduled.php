<?php


namespace telegramBotApiPhp\Types;

/**
 * Class VideoChatEnded
 * @package telegramBotApiPhp\Types
 * @method int getStartDate()
 * @method bool issetStartDate()
 */
class VideoChatScheduled extends base
{
    static protected $map = [
        'start_date' => true,
    ];
    protected $StartDate;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}