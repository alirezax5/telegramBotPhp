<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Location
 * @package telegramBotApiPhp\Types
 * @method float getLongitude()
 * @method float getLatitude()
 * @method float getHorizontalAccuracy()
 * @method int getLivePeriod()
 * @method int getHeading()
 * @method int getProximityAlertRadius()
 */
class Location extends base
{
    static protected $map = [
        'longitude' => true,
        'latitude' => true,
        'horizontal_accuracy' => true,
        'live_period' => true,
        'heading' => true,
        'proximity_alert_radius' => true,
    ];
    protected $Longitude;
    protected $Latitude;
    protected $HorizontalAccuracy;
    protected $LivePeriod;
    protected $Heading;
    protected $ProximityAlertRadius;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}