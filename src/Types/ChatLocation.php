<?php


namespace telegramBotApiPhp\Types;

/**
 * Class ChatLocation
 * @package telegramBotApiPhp\Types
 * @method Location getLocation()
 * @method string getAddress()
 */
class ChatLocation
{
    static protected $map = [
        'location' => Location::class,
        'address' => true,
    ];
    protected $Location;
    protected $Address;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}