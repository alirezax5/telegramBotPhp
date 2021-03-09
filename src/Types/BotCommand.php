<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Dice
 * @package telegramBotApiPhp\Types
 * @method string getCommand()
 * @method string getDescription()
 */
class BotCommand extends base
{
    static protected $map = [
        'command' => true,
        'description' => true,
    ];
    protected $Command;
    protected $Description;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}