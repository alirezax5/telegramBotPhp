<?php


namespace telegramBotApiPhp\Types;

/**
 * Class Sticker
 * @package telegramBotApiPhp\Types
 * @method string getFileId()
 * @method string getFileUniqueId()
 * @method int getWidth()
 * @method int getHeight()
 * @method bool getIsVideo()
 * @method bool getIsAnimated()
 * @method PhotoSize getThumb()
 * @method string getEmoji()
 * @method string getSetName()
 * @method string getPremiumAnimation()
 * @method MaskPosition getMaskPosition()
 * @method string getCustomEmojiId()
 * @method bool getNeedsRepainting()
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
        'is_video' => true,
        'thumb' => PhotoSize::class,
        'emoji' => true,
        'set_name' => true,
        'premium_animation' => File::class,
        'mask_position' => MaskPosition::class,
        'custom_emoji_id' => true,
        'needs_repainting' => true,
        'file_size' => true,
    ];

    protected $FileId;
    protected $FileUniqueId;
    protected $Width;
    protected $Height;
    protected $IsAnimated;
    protected $IsVideo;
    protected $Thumb;
    protected $Emoji;
    protected $SetName;
    protected $PremiumAnimation;
    protected $MaskPosition;
    protected $CustomEmojiId;
    protected $NeedsRepainting;
    protected $FileSize;

    protected function init($key, $value)
    {
        $this->$key = $value;
    }
}