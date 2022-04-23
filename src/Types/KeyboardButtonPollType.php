<?php


namespace telegramBotApiPhp\Types;


/**
 * Class KeyboardButtonPollType
 * @package telegramBotApiPhp\Types
 * @method string getType()
 * @method boolean issetType()

 */
class KeyboardButtonPollType extends base
{
    static protected $map = [
        'type' => true,
    ];
    protected $Type;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}