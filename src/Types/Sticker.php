<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Sticker
 * @package telegramBotApiPhp\Types
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method int getWidth()
 * @method int getHeight()
 * @method bool getIsAnimated()
 * @method PhotoSize getThumb()
 * @method string getEmoji()
 * @method string getSetName()
 * @method MaskPosition getMaskPosition()
 * @method int getFileSize()
 */
class Sticker extends base
{
    static protected $map = [
        'file_id' => true,
        'file_unique_id' => true,
        'width' => true,
        'height' => true,
        'is_animated' => true,
        'thumb' => PhotoSize::class,
        'emoji' => true,
        'set_name' => true,
        'mask_position' => MaskPosition::class,
        'file_size' => true,
    ];

    protected $FileId;
    protected $FileUniqueId;
    protected $Width;
    protected $Height;
    protected $IsAnimated;
    protected $Thumb;
    protected $Emoji;
    protected $SetName;
    protected $MaskPosition;
    protected $FileSize;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}