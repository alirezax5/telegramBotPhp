<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Venue
 * @package telegramBotApiPhp\Types
 * @method Location getLocation()
 * @method string getTitle()
 * @method string getAddress()
 * @method string getFoursquareId()
 * @method string getFoursquareType()
 * @method string getGooglePlaceId()
 * @method string getGooglePlaceType()
 */
class Venue extends base
{
    static protected $map = [
        'location' => Location::class,
        'title' => true,
        'address' => true,
        'foursquare_id' => true,
        'foursquare_type' => true,
        'google_place_id' => true,
        'google_place_type' => true,
    ];
    protected $Location;
    protected $Title;
    protected $Address;
    protected $FoursquareId;
    protected $FoursquareType;
    protected $GooglePlaceId;
    protected $GooglePlaceType;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}