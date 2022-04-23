<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Dice
 * @package telegramBotApiPhp\Types
 * @method int getTotalCount()
 * @method ArrayOfArrayOfPhotoSize getPhotos()
 */
class UserProfilePhotos extends base
{
    static protected $map = [
        'total_count' => true,
        'photos' => ArrayOfArrayOfPhotoSize::class,
    ];
    protected $TotalCount;
    protected $Photos;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}