<?php

namespace telegramBotApiPhp\Types;

/**
 * Class Venue
 * Represents a venue.
 *
 * @property Location $location Venue location. Can't be a live location.
 * @property string $title Name of the venue.
 * @property string $address Address of the venue.
 * @property string|null $foursquare_id Optional. Foursquare identifier of the venue.
 * @property string|null $foursquare_type Optional. Foursquare type of the venue. (For example, “arts_entertainment/default”, “arts_entertainment/aquarium” or “food/icecream”.)
 * @property string|null $google_place_id Optional. Google Places identifier of the venue.
 * @property string|null $google_place_type Optional. Google Places type of the venue.
 */
class Venue extends BaseType
{
}
