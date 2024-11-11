<?php


namespace telegramBotApiPhp\Types;

/**
 * Class PaidMedia
 * @package telegramBotApiPhp\Types
 * @method string getType()
 * @method string getWidth()
 * @method string getHeight()
 * @method string getDuration()
 * @method ArrayOfPhotoSize getPhoto()
 * @method Video getVideo()
 * @method boolean issetType()
 * @method boolean issetWidth()
 * @method boolean issetHeight()
 * @method boolean issetDuration()
 * @method boolean issetPhoto()
 * @method boolean issetVideo()
 */
class PaidMedia extends base
{
    static protected $map = [
        'type' => true,
        'width' => true,
        'height' => true,
        'duration' => true,
        'photo' => ArrayOfPhotoSize::class,
        'video' => Video::class,
    ];
    protected $Type;
    protected $Width;
    protected $Height;
    protected $Duration;
    protected $Photo;
    protected $Video;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}