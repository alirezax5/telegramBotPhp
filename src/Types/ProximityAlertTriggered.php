<?php


namespace telegramBotApiPhp\Types;

/**
 * Class ProximityAlertTriggered
 * @package telegramBotApiPhp\Types
 * @method User gettraveler()
 * @method User getwatcher()
 * @method int getdistance()
 */
class ProximityAlertTriggered extends base
{
    static protected $map = [
        'traveler' => User::class,
        'watcher' => User::class,
        'distance' => true,
    ];
    protected $traveler;
    protected $watcher;
    protected $distance;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}