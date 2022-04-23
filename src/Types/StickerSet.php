<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Dice
 * @package telegramBotApiPhp\Types
 * @method string getName()
 * @method string getTitle()
 * @method bool getIsAnimated()
 * @method bool getContainsMasks()
 * @method ArrayOfSticker getStickers()
 * @method PhotoSize getThumb()
 */
class StickerSet extends base
{
    static protected $map = [
        'name' => true,
        'title' => true,
        'is_animated' => true,
        'contains_masks' => true,
        'stickers' => ArrayOfSticker::class,
        'thumb' => PhotoSize::class,
    ];
    protected $Name;
    protected $Title;
    protected $IsAnimated;
    protected $ContainsMasks;
    protected $Stickers;
    protected $Thumb;


    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}