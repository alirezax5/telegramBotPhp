<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Dice
 * @package telegramBotApiPhp\Types
 * @method string getName()
 * @method string getTitle()
 * @method bool getStickerType()
 * @method bool getIsAnimated()
 * @method bool getIsVideo()
 * @method bool getContainsMasks()
 * @method ArrayOfSticker getStickers()
 * @method PhotoSize getThumb()
 */
class StickerSet extends base
{
    static protected $map = [
        'name' => true,
        'title' => true,
        'sticker_type' => true,
        'is_animated' => true,
        'is_video' => true,
        'contains_masks' => true,
        'stickers' => ArrayOfSticker::class,
        'thumb' => PhotoSize::class,
    ];
    protected $Name;
    protected $Title;
    protected $StickerType;
    protected $IsAnimated;
    protected $IsVideo;
    protected $ContainsMasks;
    protected $Stickers;
    protected $Thumb;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}