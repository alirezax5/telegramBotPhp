<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Dice
 * @package telegramBotApiPhp\Types
 * @method string getEmoji()
 * @method int getValue()
 */
class Dice extends base
{
    static protected $map = [
        'emoji' => true,
        'value' => true,
    ];
    protected $Emoji;
    protected $Value;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}